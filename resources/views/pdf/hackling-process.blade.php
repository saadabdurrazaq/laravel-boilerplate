<!DOCTYPE html>
<html>

<head>
  <title>Hackling Process</title>
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

    tr.tableNum td {
      padding-left: 5px;
      padding-right: 5.5px;
      width: 100%;
      text-align: end;
    }

    tr.tableNum th {
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
  @php
    // foreach ($production_plans as $key => $value) {
    //     $value['sample']['qty_order'] = 2;
    // }
  @endphp
  <caption style="text-align: left; padding-bottom: 10px; font-size: 25px; font-weight: bold; margin-bottom: 10px">
    <center>Hackling Process
    </center>
  </caption>
  {{-- {{ dd($production_plans[0]['sample']) }} --}}
  <div style="margin-bottom: 100px;">
    <div style="margin-bottom: 20px;">
      <div style="float: left; width: 100%">
        <table style="width: 100%; border: none;text-align:start">
          <tr style="border: none;" class="table1">
            <td style="border: none;">BUYER : {{ $production_plans[0]['customer'] ?? '' }}</td>
            {{-- {{ $production_plans[0]['style_name'] }} --}}
            <td style="border: none;">ITEM : - </td>
          </tr>
        </table>
      </div>
    </div>
    <div style="margin-top: 20px;">
      @if ($production_plans[0]['sample'])
      @foreach ($production_plans[0]['sample']['detail_json']['weight_header'] as $itemWeight)
        <table style="width: 100%;margin-top: 10px">
          <tr class="table1" style="font-weight: 500">
            <td style="width: 25%">
              {{ $itemWeight['title'] || '' }}
            </td>
            <td style="width: 25%" colspan="3">
              {{ $production_plans[0]['spec_number'] }}
            </td>
            <td colspan={{ count($production_plans[0]['sample']['mix_ratio']) }}>
              <div style="display: inline-flex;">
                @foreach ($production_plans[0]['sample']['ratio_code'] as $ratio)
                  <p style="padding-right: 3px;border:none">
                    {{ $ratio['item_name'] . '-' . (float) $ratio['percentage_ratio'] . '%' }}
                  </p>
                @endforeach
              </div>
            </td>
          </tr>
          @php
            $count = 0;
            $countTotal = 0;
            foreach ($production_plans[0]['sample']['detail_json']['selected_rows'] as $t => $item) {
                $itemArray = json_decode(json_encode($item), true);
                $arr = json_decode(json_encode($item), true);
                $count += $arr[$itemWeight['key']]['value'];
                $countTotal += $itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'];
            }
          @endphp
          <tr class="table2">
            <th>{{ $production_plans[0]['sample']['detail_json']['color_method_name'] }}</th>
            <td>&nbsp;</td>
            <td>{{ $count }}</td>
            <td>{{ $countTotal }}</td>
            @foreach ($production_plans[0]['sample']['mix_ratio'] as $item)
              <td>{{ $item['item_name'] }} / {{ (float) $item['percentage'] }}%</td>
            @endforeach
          </tr>
          @foreach ($production_plans[0]['sample']['detail_json']['selected_rows'] as $item)
            @php
              $itemArray = json_decode(json_encode($item), true);
            @endphp
            <tr class="tableNum">
              <th>{{ $itemArray['cutting'] . '-' . $itemArray['hackling'] }}</th>
              <td>{{ $itemArray['process'] }}</td>
              <td>
                {{ $itemArray[$itemWeight['key']]['value'] }}
              </td>
              <td>
                {{-- {{ $itemArray[$itemWeight['key']]['value'] * $production_plans[0]['sample']['qty_order'] }} --}}
                {{ $itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'] }}
              </td>
              @foreach ($production_plans[0]['sample']['mix_ratio'] as $item)
                <td>
                  {{ ($itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'] * (float) $item['percentage']) / 100 }}
                </td>
              @endforeach
            </tr>
          @endforeach
        </table>
      @endforeach
      @endif
    </div>
  </div>

</body>
@include('pdf.cutting-process', ['production_plans' => $production_plans])

</html>
