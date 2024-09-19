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

    tr.number td {
      padding-left: 5px;
      padding-right: 5.5px;
      width: 100%;
      text-align: end
    }

    th {
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 11.5px;
    }

    table.border-none tr td {
      border: none;
      padding-left: 5px;
      padding-right: 5.5px;
      width: 100%
    }
  </style>
</head>

<body>


  <table class="table1 " style="width: 100%">
    <tr style="width: 40%;">
      <td style="text-align:center;font-weight:500;margin:auto">
        CUTTING
      </td>
      {{-- {{ dd($production_plans[0]) }} --}}
      <td>
        <table style="width:100%">
          <tr class="table2">
            <td>
              <div class="" style="display:inline-flex">
                <b style="display:inline; margin-end: 10px">
                  BUYER : {{ $production_plans[0]['customer'] ?? '' }}
                </b>
                <p style="display:inline">
                  @if (isset($production_plans[0]['sample']) && isset($production_plans[0]['sample']['style_name']))
                  ITEM : {{ $production_plans[0]['sample']['style_name'] }}
                  @else
                  ITEM : -
                  @endif
                </p>
              </div>
            </td>
          </tr>
          <tr class="table2">
            <td>
              @if (isset($production_plans[0]['sample']) && isset($production_plans[0]['sample']['factory_code']))
              DL CODE : {{ $production_plans[0]['sample']['factory_code'] }}
              @else
              DL CODE : -
              @endif
            </td>
          </tr>
          <tr class="table2">
            <td>
              PO.NO : {{ $production_plans[0]['po_buyer_number'] ?? '' }}
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table style="width: 100%">
    <tr class="table2">
      <td style="border:none">
        TIDAK PROSES
      </td>
      <td style="border:none">
        @if (isset($production_plans[0]['sample']) && isset($production_plans[0]['sample']['ratio_code']))
        @foreach ($production_plans[0]['sample']['ratio_code'] as $ratio)
          <p style="display:inline;">
            {{ $ratio['item_name'] }} - {{ (float) $ratio['percentage_ratio'] }} %
          </p>
        @endforeach
        @endif
      </td>
    </tr>
  </table>
  <table style="width: 100%">
    <tr class=table2>
      <td style="text-align: center">LENGTH/COLOR</td>
      @if (isset($production_plans[0]['sample']) && isset($production_plans[0]['sample']['mix_ratio']))
      @foreach ($production_plans[0]['sample']['mix_ratio'] as $mix)
        <td>
          {{ $mix['item_name'] }}
        </td>
      @endforeach
      @endif
      <td>KET</td>
    </tr>
    @php
      $totalCutting = [];
      $init = 0;
    @endphp
    @if (isset($production_plans[0]['sample']) && isset($production_plans[0]['sample']['detail_json']['selected_rows']))
    @foreach ($production_plans[0]['sample']['detail_json']['selected_rows'] as $item)
      @php
        $itemArray = json_decode(json_encode($item), true);

      @endphp
      <tr class="table2">
        <td>{{ $itemArray['cutting'] . '-' . $itemArray['hackling'] }}</td>
        <td>{{ $itemArray['process'] }}</td>
        @foreach ($production_plans[0]['sample']['mix_ratio'] as $item)
          @php
            if ($init == 0) {
                $totalCutting[] =
                    ($itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'] ||
                        0 * (float) $item['percentage']) / 100;
            } else {
                $totalCutting[$loop->index] +=
                    ($itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'] ||
                        0 * (float) $item['percentage']) / 100;
            }
          @endphp
          <td>
            {{ ($itemArray[$itemWeight['key']]['value'] * $production_plans[0]['qty'] || 0 * (float) $item['percentage']) / 100 }}
          </td>
        @endforeach
        <td>-</td>
      </tr>
      @php
        $init = 1;
      @endphp
    @endforeach
    @endif
    <tr class="table2">
      <td style="text-align: center">TOTAL</td>
      @php
        $grandTotal = 0;
      @endphp
      @foreach ($totalCutting as $total)
        @php
          $grandTotal += $total;
        @endphp
        <td>
          {{ $totalCutting[$loop->index] }}
        </td>
      @endforeach
      <td>{{ $grandTotal }}</td>
    </tr>
  </table>
</body>

</html>
