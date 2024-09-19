<!DOCTYPE html>
<html>

<head>
    <title>Purchase Order</title>
    <style>
        body {

            font-family: Arial, Helvetica, sans-serif
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 15px;
            height: 2.2%;
            text-align: left;
        }

        tr.table1 td {
            padding-left: 5px;
            padding-right: 11.5px;
            width: 100%;
        }

        tr.table2 td {
            padding-left: 5px;
            padding-right: 5.5px;
            width: 100%;
        }

        tr.table3 td {
            padding-left: 5px;
            padding-right: 5.5px;
            width: 100%;
        }

        tr.table4 td {
            padding-left: 5px;
            padding-right: 5.5px;
            width: 100%;
        }

        th {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 11.5px;
            background-color: #EdEdED
        }

        table {
            margin-top: 0;
            margin-left: -25px;
        }

        h6 {
            margin-bottom: 0px;
            padding-bottom: 4px;
            font-weight: 900 !important;
            margin-left: -25px;
        }
    </style>
</head>

<body>
    <caption style="text-align: left; padding-bottom: 10px; font-size: 25px; font-weight: bold; margin-bottom: 10px">
        <center>Purchase Orders
        </center>
    </caption>
    {{-- @foreach ($production_plans[0]['sales_order'][0]['styles'] as $style) --}}
    <div style="margin-bottom: 100px;">
        <div style="margin-bottom: 20px;">
            {{-- <div style="float: left; width: 50%">
                    <table style="width: 100%; border: none;">
                        <tr style="border: none;" class="table1">
                            <th style="border: none;">BUYER :</th>
                            <td style="border: none;">{{ $production_plans[0]['sales_order'][0]['customer']['name'] }}
                            </td>
                        </tr>
                        <tr style="border: none;" class="table1">
                            <th style="border: none;">ISSUED :</th>
                            <td style="border: none;">{{ $production_plans[0]['current_date'] }}</td>
                        </tr>
                        <tr style="border: none;" class="table1">
                            <th style="border: none; width: 33%;">REF NO :</th>
                            <td style="border: none; width: 33%;">-</td>
                        </tr>
                    </table>
                </div> --}}
            <div style="float: left; width: 50%">
                <img src="{{ public_path('/image/dalim-logo-pdf.png') }}" height="30px" style="margin-left: -20px"
                    alt="">
                <h6><b>REPORT PURCHASE ORDER BY SUMMARY</b></h6>
                <table style="width: 100%;">
                    <tr style="" class="table1">
                        <th style="">Supplier</th>
                        <th style="">Purchase No.</th>
                        <th style="">Order Date</th>
                        <th style="">Delivery Date</th>
                        <th style="">Shipping Destination</th>
                        <th style="">Currency</th>
                        <th style="">QTY</th>
                        <th style="">Amount</th>
                        <th style="">Status</th>
                        <th style="">Create By</th>
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
