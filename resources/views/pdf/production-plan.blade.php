<!DOCTYPE html>
<html>

<head>
  <title>Production Plan</title>
  <style>
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
    }

    @media print {
      body {
        page-break-after: always;
      }
    }
  </style>
</head>

<body>

  <caption style="text-align: left; padding-bottom: 10px; font-size: 25px; font-weight: bold; margin-bottom: 10px">
    <center>Production Plan
    </center>
  </caption>

    <div style="margin-bottom: 100px;">
      <div style="margin-bottom: 20px;">
        <div style="float: left; width: 50%">
          <table style="width: 100%; border: none;">
            <tr style="border: none;" class="table1">
              <th style="border: none;">BUYER :</th>
              <td style="border: none;">
                {{ $production_plans[0]['sales_order'][0]['customer']['name'] ?? '' }}
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
        </div>
        <div style="float: left; width: 50%">
          <table style="width: 100%;">
            <tr style="" class="table1">
              <th style="">PPC</th>
              <th style="">STAFF</th>
              <th style="">MKT</th>
              <th style="">MGR</th>
              <th style="">DIR</th>
            </tr>
            <tr style="" class="table1">
              <td style="">-</td>
              <td style="">-</td>
              <td style="">-</td>
              <td style="">-</td>
              <td style="">-</td>
            </tr>
          </table>
        </div>
      </div>

      @foreach ($production_plans[0]['sales_order'][0]['styles'] as $style)
      <div style="margin-top: 15%;">
        <table style="width: 100%;">
          <tr style="" class="table1">
            <th style="">DATE</th>
            <td style="width: 75%;">{{ $production_plans[0]['sales_order'][0]['order_date'] }}</td>
            <th style="width: 40%;">PO NO</th>
            <td style="width: 45%;">{{ $production_plans[0]['wip']->wo_sheet }}</td>
            <th style="">ETD</th>
            <td style="">{{ $production_plans[0]['sales_order'][0]['shipping_date'] }}</td>
            <th style="">D-NO</th>
            <td style="">-</td>
          </tr>
          <tr style="" class="table1">
            <th style="">ITEM</th>
            <td colspan="3" style="">{{ $style['style_name'] }}</td>
            <th style="width: 40%;">CODE</th>
            <td style="">{{ $style['style_code'] }}</td>
            <th style="">MONO</th>
            <td style="">-</td>
          </tr>
        </table>
        <br>

        <table style="width: 100%; page-break-inside: avoid;">
          <tr style="width: 100%;" class="table2">
            <th rowspan="3" style="width: 1%;">SUB MATERIAL</th>
            <th style="">BOX</th>
            <td style="width: 100%">
              @foreach ($style['packing_material_style_details'] as $styleIndex => $pmsd)
                {{ $style['packing_material_style_details'][$styleIndex]['name'] ?? '' }},
              @endforeach
            </td>
            <th style="">TAG</th>
            <td style="width: 3%">-</td>
          </tr>
          <tr style="width: 100%;" class="table2">
            <th style="">INSERT</th>
            <td style="width: 100%">
              @foreach ($style['bom'] as $styleIndex => $pmsd)
                {{ $style['bom'][$styleIndex]['name'] ?? '' }},
              @endforeach
            </td>
            <th style="">T.CLIP</th>
            <td style="width: 3%">-</td>
          </tr>
          <tr style="width: 100%;" class="table2">
            <th style="">LABEL</th>
            <td style="width: 100%">-</td>
            <th style="">OTHERS</th>
            <td style="width: 3%">-</td>
          </tr>
        </table>
        <br>

        <table style="width: 100%; page-break-inside: avoid;">
          <tr style="width: 100%;" class="table3">
            <th style="">CAP</th>
            <th style="">GR</th>
            <th style="">BE</th>
            <th style="">LB</th>
            <th style="">MB</th>
            <th style="">DB</th>
            <th style="">TOTAL</th>
            <th style="">CELUP</th>
            <th style="">FINISHING</th>
            <th style="">LWET</th>
          </tr>
          <tr style="width: 100%;" class="table3">
            <th style="">TOTAL</th>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            {{-- {{ $style['finishing_type_name'] }} --}}
            <td>-</td>
            {{-- {{ $style['packing_method_name'] }} --}}
            <td>-</td>
          </tr>
        </table>
        <br>
        <table style="width: 100%; page-break-inside: avoid;">
          <tr style="" class="table4">
            <th style="width: 1%;">NO</th>
            <th style="width: 2%">PROCESS</th>
            <th style="width: 50%">COLOR METHOD</th>
            <th style="width: 2%">CAP</th>
            <th style="width: 2%">SIZE</th>
            <th style="width: 2%">QTY</th>
            <th style="width: 50%">COLOR NAME</th>
            <th style="">BARCODE</th>
          </tr>
          @foreach ($style['selected_colors'] as $selectedColors)
            <tr style="" class="table4">
              <td style="width: 1%;">{{ $selectedColors['increment_value'] }}</td>
              <td style="width: 2%">{{ $selectedColors['process'] }}</td>
              <td style="width: 50%">{{ $selectedColors['color_method'] }}</td>
              <td style="width: 2%;">-</td>
              <td style="width: 2%;">-</td>
              <td style="width: 2%;">{{ $selectedColors['target_qty'] }}</td>
              <td style="width: 50%">{{ $selectedColors['color_variant'] }}</td>
              <td>{{ $selectedColors['barcode'] }}</td>
            </tr>
          @endforeach
        </table>
      </div>
      @endforeach
    </div>

</body>
@include('pdf.hackling-process', ['production_plans' => $production_plans])

</html>
