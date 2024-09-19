<!DOCTYPE html>
<html>

<head>
    <title>Purchase Order</title>
</head>

<body>
    {{-- @foreach ($production_plans[0]['sales_order'][0]['styles'] as $style) --}}
    <div style="margin-bottom: 100px;">
        <div style="margin-bottom: 20px;">
            <div style="float: left; width: 50%">
                <h6><b>REPORT PURCHASE ORDER BY SUMMARY</b></h6>
                <table style="width: 100%;">
                    <tr style="" class="table1">
                        <th style="width: 300px; background-color: yellow !important;">Supplier</th>
                        <th style="width: 300px; background-color: yellow !important;">Purchase No.</th>
                        <th style="width: 300px; background-color: yellow !important;">Order Date</th>
                        <th style="width: 300px; background-color: yellow !important;">Delivery Date</th>
                        <th style="width: 300px; background-color: yellow !important;">Shipping Destination</th>
                        <th style="width: 300px; background-color: yellow !important;">Currency</th>
                        <th style="width: 300px; background-color: yellow !important;">QTY</th>
                        <th style="width: 300px; background-color: yellow !important;">Amount</th>
                        <th style="width: 300px; background-color: yellow !important;">Status</th>
                        <th style="width: 300px; background-color: yellow !important;">Create By</th>
                    </tr>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach ($purchase_orders as $item)
                        <tr>
                            <td>{{ $item->supplier?->name ?? '-' }}</td>
                            <td>{{ $item->purchase_order_number ?? '-' }}</td>
                            <td>{{ $item->purchase_order_date ?? '-' }}</td>
                            <td>{{ $item->shipping_date ?? '-' }}</td>
                            <td>{{ $item->shipping_destination ?? '-' }}</td>
                            <td>{{ $item->currency?->name ?? '-' }}</td>
                            <td>{{ $item->qty ?? 0 }}</td>
                            <td>{{ $item->total_amount }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_by?->name ?? '-' }}</td>
                        </tr>
                        @php
                            $totalAmount += $item->total_amount ?? 0;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="7" style="text-align: center">Total Amount</td>
                        <td>{{ $totalAmount }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
</body>

</html>
