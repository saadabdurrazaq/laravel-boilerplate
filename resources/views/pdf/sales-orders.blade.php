<!DOCTYPE html>
<html>

<head>
    <title>List of Sales Orders</title>
    {{-- <link rel="stylesheet" href="{{ asset('public/css/style.css') }}"> --}}
    <style>
        table#miyazaki {
            margin: 0 auto;
            border-collapse: collapse;
            font-family: Agenda-Light, sans-serif;
            font-weight: 100;
            background: #333;
            color: #fff;
            text-rendering: optimizeLegibility;
            border-radius: 5px;
        }

        table#miyazaki caption {
            font-size: 2rem;
            color: #444;
            margin: 1rem;
            background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/miyazaki.png), url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/miyazaki2.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center left, center right;
        }

        table#miyazaki thead th {
            font-weight: 600;
        }

        table#miyazaki thead th,
        table#miyazaki tbody td {
            padding: .8rem;
            font-size: 0.8rem;
        }

        table#miyazaki tbody td {
            padding: .8rem;
            font-size: 0.8rem;
            color: #444;
            background: #eee;
        }

        table#miyazaki tbody tr:not(:last-child) {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        @media screen and (max-width: 600px) {
            table#miyazaki caption {
                background-image: none;
            }

            table#miyazaki thead {
                display: none;
            }

            table#miyazaki tbody td {
                display: block;
                padding: .6rem;
            }

            table#miyazaki tbody tr td:first-child {
                background: #666;
                color: #fff;
            }

            table#miyazaki tbody td:before {
                content: attr(data-th);
                font-weight: bold;
                display: inline-block;
                width: 6rem;
            }
        }
    </style>
</head>

<body>
    <table id="miyazaki">
        <caption style="text-align: left; padding-bottom: 10px; font-size: 20px;">Report Sales Order By Summary
        </caption>
        <thead>
            <tr>
                <th>Purchase No.</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Shipping Destination</th>
                <th>Currency</th>
                <th>QTY</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created By</th>
            </tr>
        <tbody>
            @foreach ($sales_orders as $sales_order)
                <tr>
                    <td>{{ $sales_order['buyer_po_number'] }}</td>
                    <td>{{ $sales_order['order_date'] }}</td>
                    <td>{{ $sales_order['shipping_date'] }}</td>
                    <td>{{ $sales_order['shipping_destination'] }}</td>
                    <td>{{ $sales_order['currency']->name }}</td>
                    <td>{{ $sales_order['qty'] }}</td>
                    <td>{{ $sales_order['total_amount'] }}</td>
                    <td>{{ $sales_order['status'] }}</td>
                    <td>{{ $sales_order['created_by'] }}</td>
                </tr>
            @endforeach
    </table>
</body>

</html>
