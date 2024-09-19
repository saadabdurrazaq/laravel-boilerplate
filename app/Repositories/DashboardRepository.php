<?php

namespace App\Repositories;

use App\Models\Inventory\InventoryIn;
use App\Models\Master\CustomerType;
use App\Models\Orders\{SalesHasStyle};
use App\Models\Orders\SalesOrder;
use App\Models\Production\ProductionPlan;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Shipping\Shipping;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersPerformanceExport;
use App\Exports\SOPerformanceExport;
use App\Exports\ConsumptionItemsExport;
use App\Exports\StockAvailabilityExport;

class DashboardRepository
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAll(): array
    {
        return [
            'sales_order' => $this->salesOrder(),
            'shipping' => $this->shipping(),
            'production' => $this->production(),
            'purchase_order' => $this->purchase(),
            'inventory' => $this->inventory(),
            'inventory_in' => $this->inventoryIn(),
            'inventory_out' => $this->inventoryOut(),
            'sales_invoice' => $this->salesInvoice(),
        ];
    }

    public function purchase(): array
    {
        $purchase = PurchaseOrder::query()
            ->select('id', 'purchase_order_date', 'total_amount')
            ->when(request()->filled('start_date') && request()->filled('end_date'), fn ($q) => $q->whereBetween('purchase_order_date', [request()->query('start_date'), request()->query('end_date')]));

        return [
            'total_count' => $purchase->count('id'),
            'total_amount' => (float) $purchase->sum('total_amount')
        ];
    }

    public function salesOrder(): array
    {
        $sales = SalesOrder::query()
            ->select('id', 'order_date')
            ->when(request()->filled('start_date') && request()->filled('end_date'), fn ($q) => $q->whereBetween('order_date', [request()->query('start_date'), request()->query('end_date')]));

        // query for create chart in sales order by month
        $salesChart = SalesOrder::query()
            ->selectRaw('count(id) as total, month(order_date) as month')
            ->whereYear('order_date', request()->filled('start_date') ? Carbon::parse(request()->query('start_date'))->format('Y') : date('Y'))
            ->groupBy('month')
            ->get();

        foreach ($salesChart as $s) $s->month = Carbon::parse($s->month)->format('F');

        return [
            'total_count' => $sales->count('id'),
            'total_amount' => (float) SalesHasStyle::whereIn('sales_order_id', $sales->limit(5_000)->get()->pluck('id'))->sum('amount'),
            'chart' => $salesChart
        ];
    }

    public function inventory(): array
    {
        $inventory = InventoryIn::query()
            ->select('id', 'ingoing_date')
            ->when(request()->filled('start_date') && request()->filled('end_date'), fn ($q) => $q->whereBetween('purchase_order_date', [request()->query('start_date'), request()->query('end_date')]));

        return [
            'total_count' => $inventory->count('id'),
            //            'total_amount' => (float) $inventory->sum('total_amount'),
            'total_amount' => 69,
            'note' => 'Not yet implemented'
        ];
    }

    public function inventoryIn(): array
    {
        return [
            'total_count' => 0,
            'total_amount' => 0,
            'note' => 'Not yet implemented'
        ];
    }

    public function inventoryOut(): array
    {
        return [
            'total_count' => 0,
            'total_amount' => 0,
            'note' => 'Not yet implemented'
        ];
    }

    public function production(): array
    {
        $production = ProductionPlan::query()
            ->select('id', 'start_date', 'order_qty', 'target_qty')
            ->when(request()->filled('start_date') && request()->filled('end_date'), fn ($q) => $q->whereBetween('start_date', [request()->query('start_date'), request()->query('end_date')]));

        return [
            'total_count' => $production->count('id'),
            'total_order_qty' => (int) $production->sum('order_qty'),
            'total_target_qty' => (int) $production->sum('target_qty')
        ];
    }

    public function shipping(): array
    {
        $shipping = Shipping::query()
            ->select('id', 'shipping_date', 'total_amount')
            ->when(request()->filled('start_date') && request()->filled('end_date'), fn ($q) => $q->whereBetween('shipping_date', [request()->query('start_date'), request()->query('end_date')]));

        return [
            'total_count' => $shipping->count('id'),
            'total_amount' => (float) $shipping->sum('total_amount')
        ];
    }

    public function salesInvoice(): array
    {
        return [
            'total_count' => 0,
            'total_amount' => 0,
            'note' => 'Not yet implemented'
        ];
    }

    public function limitDecimals($number, $decimals)
    {
        return number_format($number, $decimals, '.', '');
    }

    public function customersBuilder(): QBuilder
    {
        $reqStartDate = request('start_date');
        $reqEndDate = request('end_date');
        $startDate = empty($reqStartDate) ? null : $reqStartDate;
        $endDate = empty($reqEndDate) ? null : $reqEndDate;

        $customerType = CustomerType::where('name', 'BUYER')->first();

        $dateCondition = '';
        $bindings = [];

        if ($startDate && $endDate) {
            $dateCondition = 'AND sales_orders.order_date BETWEEN ? AND ?';
            $bindings = [
                $startDate, $endDate, // total_orders
                $startDate, $endDate, // total_styles
                $startDate, $endDate, // total methods
                $startDate, $endDate
            ];
        }

        $customersData = DB::table('customers')
            ->join('customer_types', 'customer_types.id', '=', 'customers.customer_type_id')
            ->selectRaw(
                '
                customers.id as customer_id,
                customers.name as customer_name,
                (
                   SELECT SUM(COALESCE(sales_has_styles.qty, 0))
                   FROM sales_orders
                   INNER JOIN sales_has_styles ON sales_has_styles.sales_order_id = sales_orders.id
                   WHERE sales_orders.customer_id = customers.id
                   ' . $dateCondition .
                    '
                ) as total_orders,
                (
                   SELECT COUNT(DISTINCT styles.id)
                   FROM styles
                   INNER JOIN sales_orders ON sales_orders.customer_id = styles.customer_id
                   WHERE styles.customer_id = customers.id
                   ' . $dateCondition .
                    '
                ) as total_styles,
                (
                   SELECT COUNT(DISTINCT color_methods.id)
                   FROM
                       sales_orders
                       INNER JOIN sales_order_and_style_has_color_methods ON sales_orders.id = sales_order_and_style_has_color_methods.sales_order_id
                       LEFT JOIN color_methods ON color_methods.id = sales_order_and_style_has_color_methods.color_method_id
                   WHERE
                       sales_orders.customer_id = customers.id
                   ' . $dateCondition . '
                ) as total_methods,
                (
                   SELECT COUNT(COALESCE(color_variants.id, 0))
                   FROM color_methods
                   INNER JOIN color_variants ON color_variants.color_method_id = color_methods.id
                   WHERE color_methods.customer_id = customers.id
                ) as total_stamps,
                (
                   SELECT SUM(COALESCE(sales_orders.grand_total, 0))
                   FROM sales_orders
                   WHERE sales_orders.customer_id = customers.id
                   ' . $dateCondition . '
                ) as order_values
            ',
                $bindings
            )
            ->where('customers.customer_type_id', '=', $customerType?->id)
            ->whereNull('customers.deleted_at')
            ->orderBy('order_values', 'desc');

        return $customersData;
    }

    public function salesOrdersBuilder(): QBuilder
    {
        $reqStartDate = request('start_date');
        $reqEndDate = request('end_date');
        $startDate = empty($reqStartDate) ? null : $reqStartDate;
        $endDate = empty($reqEndDate) ? null : $reqEndDate;

        $salesData = DB::table('sales_orders')
            ->selectRaw(
                '
                sales_orders.id as sales_order_id,
                sales_orders.buyer_po_number as buyer_po_number,
                COALESCE((
                    SELECT SUM(sales_has_styles.qty)
                    FROM sales_has_styles
                    WHERE sales_has_styles.sales_order_id = sales_orders.id
                ), 0) AS qty_orders,
                SUM(sales_orders.grand_total) AS order_value,
                COALESCE((
                    SELECT SUM(list_of_plans.wip_qty)
                    FROM list_of_plans
                    INNER JOIN production_plans ON production_plans.id = list_of_plans.production_plan_id
                    WHERE production_plans.sales_order_id = sales_orders.id
                ), 0) AS production_qty,
                COALESCE((
                    SELECT SUM(shipping_lists.shipping_qty)
                    FROM shipping_lists
                    WHERE shipping_lists.sales_order_id = sales_orders.id
                ), 0) AS shipping_qty,
                COALESCE((
                    SELECT SUM(sales_invoice_shipping_list.qty) * SUM(sales_invoice_shipping_list.unit_price)
                    FROM sales_invoice_shipping_list
                    INNER JOIN shipping_lists ON shipping_lists.id = sales_invoice_shipping_list.shipping_list_id
                    WHERE shipping_lists.sales_order_id = sales_orders.id
                ), 0) AS invoice_amount
                '
            )
            ->groupBy('sales_orders.id', 'sales_orders.buyer_po_number');

        if ($startDate && $endDate) {
            $salesData = $salesData->whereBetween('sales_orders.order_date', [$startDate, $endDate]);
        }

        $salesData = $salesData->orderBy('order_value', 'desc');

        return $salesData;
    }

    public function consumptionItemsBuilder(): QBuilder
    {
        $reqStartDate = request('start_date');
        $reqEndDate = request('end_date');
        $startDate = empty($reqStartDate) ? null : $reqStartDate;
        $endDate = empty($reqEndDate) ? null : $reqEndDate;

        $dateCondition = '';
        $bindings = [];

        if ($startDate && $endDate) {
            $dateCondition = 'AND sales_orders.order_date BETWEEN ? AND ?';
            $bindings = [
                $startDate, $endDate, // total_orders
                $startDate, $endDate // total_styles
            ];
        }

        $consumptionItemsData = DB::table('items')
            ->selectRaw(
                '
                items.id as item_id,
                items.name as item_name,
                COALESCE((
                    SELECT SUM(bom_style_details.consumption)
                    FROM bom_style_details
                    INNER JOIN sales_has_styles ON sales_has_styles.style_id = bom_style_details.item_style_id
                    INNER JOIN sales_orders ON sales_orders.id = sales_has_styles.sales_order_id
                    WHERE bom_style_details.item_id = items.id
                    ' . $dateCondition .
                    '
                ), 0) AS total_consumptions,
                COALESCE((
                    SELECT count(sales_orders.id)
                    FROM bom_style_details
                    INNER JOIN sales_has_styles ON sales_has_styles.style_id = bom_style_details.item_style_id
                    INNER JOIN sales_orders ON sales_orders.id = sales_has_styles.sales_order_id
                    WHERE bom_style_details.item_id = items.id
                    ' . $dateCondition . '
                ), 0) AS total_so,
                COALESCE((
                    SELECT SUM(purchase_order_details.qty)
                    FROM purchase_order_details
                    INNER JOIN purchase_orders ON purchase_orders.id = purchase_order_details.po_id
                    WHERE purchase_order_details.item_id = items.id
                ), 0) AS purchase_completion,
                COALESCE((
                    SELECT SUM(purchase_order_details.qty * purchase_order_details.price * purchase_orders.exchange_rate)
                    FROM purchase_order_details
                    INNER JOIN purchase_orders ON purchase_orders.id = purchase_order_details.po_id
                    WHERE purchase_order_details.item_id = items.id
                ), 0) AS purchase_value,
                COALESCE((
                    SELECT SUM(purchase_invoice_purchase_order_detail.qty * purchase_invoice_purchase_order_detail.price * purchase_invoices.exchange_rate)
                    FROM purchase_invoice_purchase_order_detail
                    INNER JOIN purchase_order_details ON purchase_order_details.id = purchase_invoice_purchase_order_detail.p_o_d_id
                    INNER JOIN purchase_invoices ON purchase_invoices.id = purchase_invoice_purchase_order_detail.p_i_id
                    WHERE purchase_order_details.item_id = items.id
                ), 0) AS purchase_invoice
                ',
                $bindings
            )
            // TAKES TOO MUCH TIME
            // ->orderByRaw(
            //     '
            //     COALESCE((
            //         SELECT SUM(bom_style_details.consumption)
            //         FROM bom_style_details
            //         INNER JOIN sales_has_styles ON sales_has_styles.style_id = bom_style_details.item_style_id
            //         INNER JOIN sales_orders ON sales_orders.id = sales_has_styles.sales_order_id
            //         WHERE bom_style_details.item_id = items.id
            //     ), 0) DESC'
            // )
            ->orderBy('total_consumptions', 'desc');

        return $consumptionItemsData;
    }

    public function stockAvailabilityBuilder(): QBuilder
    {
        $stockAvailability = DB::table('items')
            ->selectRaw(
                '
                subquery.*,
                (COALESCE(wh_qty, 0) - COALESCE(total_consumption, 0)) AS balance_actual,
                (COALESCE(purchase_qty, 0) - COALESCE(total_consumption, 0)) AS balance_purchase
                '
            )
            ->leftJoin(
                DB::raw('(SELECT
                 items.id,
                 items.name,
                 COALESCE((
                     SELECT SUM(bom_style_details.consumption)
                     FROM bom_style_details
                     INNER JOIN sales_has_styles ON sales_has_styles.style_id = bom_style_details.item_style_id
                     INNER JOIN sales_orders ON sales_orders.id = sales_has_styles.sales_order_id
                     WHERE bom_style_details.item_id = items.id
                 ), 0) AS total_consumption,
                 COALESCE((
                     SELECT SUM(stock.qty)
                     FROM stock
                     WHERE stock.item_id = items.id
                 ), 0) AS wh_qty,
                 COALESCE((
                     SELECT SUM(purchase_order_details.qty)
                     FROM purchase_order_details
                     INNER JOIN purchase_orders ON purchase_orders.id = purchase_order_details.po_id
                     WHERE purchase_order_details.item_id = items.id
                 ), 0) AS purchase_qty
                 FROM items) AS subquery'),
                'items.id',
                '=',
                'subquery.id'
            )
            ->whereNotNull('total_consumption')
            ->orderByDesc('total_consumption');

        return $stockAvailability;
    }

    public function getCustomers()
    {
        $customersData = ($this->customersBuilder())
            ->get();

        $formattedData = [];

        $customersData = collect($customersData)->groupBy('customer_id');
        foreach ($customersData as $index => $customersDataResults) {
            $formattedData[$index] = [
                'customer_id' => $customersDataResults[0]->customer_id,
                'customer_name' => $customersDataResults[0]->customer_name,
                'total_orders' => $customersDataResults[0]->total_orders === null ? 0 : $customersDataResults[0]->total_orders,
                'total_styles' => $customersDataResults[0]->total_styles === null ? 0 : $customersDataResults[0]->total_styles,
                'total_methods' => $customersDataResults[0]->total_methods === null ? 0 : $customersDataResults[0]->total_methods,
                'total_stamps' => $customersDataResults[0]->total_stamps === null ? 0 : $customersDataResults[0]->total_stamps,
                'order_values' => $customersDataResults[0]->order_values === null ? 0 : $customersDataResults[0]->order_values,
            ];
        };

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['customers'] = getPaginatedData(collect($formattedData));

        return $datas;
    }

    public function getSalesOrders()
    {
        $salesData = ($this->salesOrdersBuilder())
            ->paginate(request()->query('per_page', 10));

        $salesData->getCollection()->transform(function ($salesVal) {
            $salesDatas = [];

            $salesDatas['sales_order_id'] = $salesVal->sales_order_id;
            $salesDatas['buyer_po_number'] = $salesVal->buyer_po_number;
            $salesDatas['qty_orders'] = $salesVal->qty_orders;
            $salesDatas['order_value'] = $salesVal->order_value;
            $salesDatas['production_qty'] = $salesVal->production_qty;
            $salesDatas['shipping_qty'] = $salesVal->shipping_qty;
            $salesDatas['invoice_amount'] = $this->limitDecimals($salesVal->invoice_amount, 3);

            return $salesDatas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['sales_orders'] = $salesData;

        return $datas;
    }

    public function getConsumptionItems()
    {
        $consumptionItemsData = ($this->consumptionItemsBuilder())
            ->paginate(request()->query('per_page', 10));

        $consumptionItemsData->getCollection()->transform(function ($consumptionItemsVal) {
            $consumptionItemsDatas = [];

            $consumptionItemsDatas['item_id'] = $consumptionItemsVal->item_id;
            $consumptionItemsDatas['item_name'] = $consumptionItemsVal->item_name;
            $consumptionItemsDatas['total_consumptions'] = $consumptionItemsVal->total_consumptions;
            $consumptionItemsDatas['total_so'] = $consumptionItemsVal->total_so;
            $consumptionItemsDatas['purchase_completion'] = $consumptionItemsVal->purchase_completion;
            $consumptionItemsDatas['purchase_value'] = $this->limitDecimals($consumptionItemsVal->purchase_value, 3);
            $consumptionItemsDatas['purchase_invoice'] = $this->limitDecimals($consumptionItemsVal->purchase_invoice, 3);

            return $consumptionItemsDatas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['consumption_items'] = $consumptionItemsData;

        return $datas;
    }

    public function getStockAvailability()
    {
        $stockAvailability = ($this->stockAvailabilityBuilder())
            ->paginate(request()->query('per_page', 10));
        // ->take(150)
        // ->get();

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['stock_availability'] = $stockAvailability; // getPaginatedData($stockAvailability, $perPage);

        return $datas;
    }

    public function getCustomersCSV()
    {
        $customersData = ($this->customersBuilder())
            ->get();

        $customersData = $customersData->map(function ($customerVal) {
            $customerDatas = [];

            $customerDatas['customer_id'] = $customerVal->customer_id;
            $customerDatas['customer_name'] = $customerVal->customer_name;
            $customerDatas['total_orders'] = $customerVal->total_orders === null ? 0 : $customerVal->total_orders;
            $customerDatas['total_styles'] = $customerVal->total_styles === null ? 0 : $customerVal->total_styles;
            $customerDatas['total_methods'] = $customerVal->total_methods === null ? 0 : $customerVal->total_methods;
            $customerDatas['total_stamps'] = $customerVal->total_stamps === null ? 0 : $customerVal->total_stamps;
            $customerDatas['order_values'] = $customerVal->order_values === null ? 0 : $customerVal->order_values;

            return $customerDatas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['customers'] = $customersData;

        return $datas;
    }

    public function getSalesOrdersCSV()
    {
        $salesData = ($this->salesOrdersBuilder())
            ->get();

        $salesData =  $salesData->map(function ($salesVal) {
            $salesDatas = [];

            $salesDatas['sales_order_id'] = $salesVal->sales_order_id;
            $salesDatas['buyer_po_number'] = $salesVal->buyer_po_number;
            $salesDatas['qty_orders'] = $salesVal->qty_orders;
            $salesDatas['order_value'] = $salesVal->order_value;
            $salesDatas['production_qty'] = $salesVal->production_qty;
            $salesDatas['shipping_qty'] = $salesVal->shipping_qty;
            $salesDatas['invoice_amount'] = $this->limitDecimals($salesVal->invoice_amount, 3);

            return $salesDatas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['sales_orders'] = $salesData;

        return $datas;
    }

    public function getConsumptionItemsCSV()
    {
        $consumptionItemsData = ($this->consumptionItemsBuilder())
            ->get();

        $consumptionItemsData = $consumptionItemsData->map(function ($consumptionItemsVal) {
            $consumptionItemsDatas = [];

            $consumptionItemsDatas['item_id'] = $consumptionItemsVal->item_id;
            $consumptionItemsDatas['item_name'] = $consumptionItemsVal->item_name;
            $consumptionItemsDatas['total_consumptions'] = $consumptionItemsVal->total_consumptions;
            $consumptionItemsDatas['total_so'] = $consumptionItemsVal->total_so;
            $consumptionItemsDatas['purchase_completion'] = $consumptionItemsVal->purchase_completion;
            $consumptionItemsDatas['purchase_value'] = $this->limitDecimals($consumptionItemsVal->purchase_value, 3);
            $consumptionItemsDatas['purchase_invoice'] = $this->limitDecimals($consumptionItemsVal->purchase_invoice, 3);

            return $consumptionItemsDatas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['consumption_items'] = $consumptionItemsData;

        return $datas;
    }

    public function getStockAvailabilityCSV()
    {
        $stockAvailability = ($this->stockAvailabilityBuilder())
            ->get();
        // ->take(150)
        // ->get();

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['stock_availability'] = $stockAvailability; // getPaginatedData($stockAvailability, $perPage);

        return $datas;
    }

    public function exportCSVCustomers()
    {
        $reportName = 'customers-performance-period';

        return Excel::download(
            new CustomersPerformanceExport($this->request, $this),
            $reportName,
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function exportCSVSalesOrders()
    {
        $reportName = 'sales-orders-performance-period';

        return Excel::download(
            new SOPerformanceExport($this->request, $this),
            $reportName,
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function exportCSVConsumptionItems()
    {
        $reportName = 'consumption-items';

        return Excel::download(
            new ConsumptionItemsExport($this->request, $this),
            $reportName,
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function exportCSVStockAvailability()
    {
        $reportName = 'stock-availability';

        return Excel::download(
            new StockAvailabilityExport($this->request, $this),
            $reportName,
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
