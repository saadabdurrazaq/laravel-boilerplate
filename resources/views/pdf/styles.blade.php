<!DOCTYPE html>
<html>

<head>
    <title>List of Styles</title>
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
        <caption style="text-align: left; padding-bottom: 10px; font-size: 20px;">Report Master Style
        </caption>
        <thead>
            <tr>
                <th>Style Code</th>
                <th>Buyer</th>
                <th>Style Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Unit</th>
                <th>Collection</th>
                <th>SKU Buyer</th>
            </tr>
        <tbody>
            @foreach ($styles as $style)
                <tr>
                    <td>{{ $style['style_code'] }}</td>
                    <td>{{ $style['customer']->name??'' }}</td>
                    <td>{{ $style['style_name'] }}</td>
                    <td>{{ $style['description'] }}</td>
                    <td>{{ $style['price'] }}</td>
                    <td>{{ $style['unit']->name?'' }}</td>
                    <td>{{ $style['collection']->name?'' }}</td>
                    <td>{{ $style['sku_buyer'] }}</td>
                </tr>
            @endforeach
    </table>
</body>

</html>
