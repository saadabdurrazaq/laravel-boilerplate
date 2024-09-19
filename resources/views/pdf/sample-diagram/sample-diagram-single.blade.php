<!DOCTYPE html>
<html>

<head>
    <title>PDF Inventory IN</title>
    <style>
        @page {
            margin: 25px;
        }

        .header {
            font-size: 30px;
            color: #0877BB;
            margin: 0px;
        }

        .table-header-padding {
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 5px;
            padding-top: 5px;
        }

        p {
            margin: 0;
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
        }

        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }
    </style>
</head>

<body>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td width="10%">
            <table cellspacing="5" cellpadding="0" width="100%">
              <tr>
                <td>
                  <img src="{{ public_path('/image/dalim-logo.png') }}" alt="logo">
                </td>
              </tr>
            </table>
          </td>
          <td width="50%" align="right">
            <table width="100%" cellspacing="0" cellpadding="5" border="0">
              <tr>
                <td>
                  <p class="header" style="text-align: right;"><b>SAMPLE DIAGRAM</b></p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 30px;">
        <tr>
          <td width="50%">
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td>
                  <p><b>{{ $company_profile['name'] }}</b></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="font-size: 14px; padding-top: 10px">
                    {{ $company_profile['address'] }}
                  </p>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="font-size: 14px; padding-top: 10px">
                    Phone : {{ $company_profile['phone'] }}
                  </p>
                </td>
              </tr>
            </table>
          </td>
          <td width="50%" align="right">
            <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-size: 14px">
              <tr>
                <td>
                  <p style="text-align: right;">BUYER NAME</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <td>
                        <p style="text-align: center;">{{ $buyer_name }}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="text-align: right;">COLOR METHOD</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <p style="text-align: center;">{{ $color_method_name }}</p>
                    </tr>
                  </table>
                </td>
              </tr>

              <tr>
                <td>
                  <p style="text-align: right;">MIX RATIO</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <p style="text-align: center;">{{ $ratio_code }}</p>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="text-align: right;">STYLE</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <p style="text-align: center;">{{ $style_name }}</p>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="text-align: right;">FACTORY CODE</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <p style="text-align: center; width: 100%">{{ $factory_code }}</p>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="text-align: right;">SPEC NUMBER</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <p style="text-align: center; width: 100%">{{ $spec_number }}</p>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top: 25px; font-size: 14px">
        <tr>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Process</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Cutting</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Hackling</p>
            </td>
            @foreach ($header_weights as $headerWeight)
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">W/{{ $headerWeight['name'] }}</p>
                </td>
            @endforeach
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Length</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Panjang</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Pipe</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
                <p class="table-header-padding">Color</p>
            </td>
        </tr>
        @foreach ($selected_rows as $selectedRowIndex => $selectedRow)
            <tr>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['process'] }}
                    </p>
                </td>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['cutting'] === 0 ? '' : $selectedRow['cutting'] }}
                    </p>
                </td>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['hackling'] === 0 ? '' : $selectedRow['hackling'] }}
                    </p>
                </td>

                @isset($selectedRow['weight_1'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_1']['value'] === 0 ? '' : $selectedRow['weight_1']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_2'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_2']['value'] === 0 ? '' : $selectedRow['weight_2']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_3'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_3']['value'] === 0 ? '' : $selectedRow['weight_3']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_4'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_4']['value'] === 0 ? '' : $selectedRow['weight_4']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_5'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_5']['value'] === 0 ? '' : $selectedRow['weight_5']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_6'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_6']['value'] === 0 ? '' : $selectedRow['weight_6']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_7'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_7']['value'] === 0 ? '' : $selectedRow['weight_7']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_8'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_8']['value'] === 0 ? '' : $selectedRow['weight_8']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_9'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_9']['value'] === 0 ? '' : $selectedRow['weight_9']['value'] }}
                    </p>
                </td>
                @endisset

                @isset($selectedRow['weight_10'])
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['weight_10']['value'] === 0 ? '' : $selectedRow['weight_10']['value'] }}
                    </p>
                </td>
                @endisset

                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['length'] === 0 ? '' : $selectedRow['length'] }}
                    </p>
                </td>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['panjang'] === 0 ? '' : $selectedRow['panjang'] }}
                    </p>
                </td>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['pipe'] === 0 ? '' : $selectedRow['pipe'] }}
                    </p>
                </td>
                <td>
                    <p style="text-align: left;padding-left: 8px; padding-top:3px; padding-bottom:3px">
                        {{ $selectedRow['color'] }}
                    </p>
                </td>
            </tr>
        @endforeach

    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 30px;">

    </table>
</body>

</html>
