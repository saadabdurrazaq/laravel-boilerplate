<!DOCTYPE html>
<html>

<head>
  <title>PDF Style</title>
  <style>
    @page {
      margin: 25px;
    }

    .header {
      font-size: 30px;
      color: #0877BB;
      margin: 0px;
    }

    .title {
      color: black;
      font-size: 15px;
      font-weight: bold;
      padding-left: 5px;
      padding-top: 15px;
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

  <div>
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
                <p class="header" style="text-align: right;"><b>
                    STYLE DETAIL</b></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 10px;margin-bottom: 20px">
      <tr>
        <td width="48%">
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
      </tr>
    </table>


    <table style="margin-top: 25px;" width="100%">
      <tr style="background-color: #0877BB;">
        <td colspan="3" width="100%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">Basic Information</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr width="100%">
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="30%">Style Code </td>
              <td width="70%">{{ $style['style_code'] }}</td>
            </tr>
            <tr>
              <td width="30%">Buyer </td>
              <td width="70%">{{ $style['customer']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="30%">Style Name </td>
              <td width="70%">{{ $style['style_name'] }}</td>
            </tr>
            <tr>
              <td width="30%">Description </td>
              <td width="70%">{{ $style['description'] }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table width="100%" style="margin-top: 5px;">
            <tr>
              <td width="30%">Price </td>
              <td width="70%">{{ $style['price'] }}</td>
            </tr>
            <tr>
              <td width="30%">Unit </td>
              <td width="70%">{{ $style['unit']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="30%">Collection </td>
              <td width="70%">{{ $style['collection']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="30%">SKU Buyer </td>
              <td width="70%">{{ $style['sku_buyer'] }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table style="margin-top: 25px;" width="100%">
      <tr style="background-color: #0877BB;">
        <td colspan="3" width="100%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">CAP Information</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3" width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="15%">CAP Type </td>
              <td width="85%">{{ $style['cap_type']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="15%">Factory Code </td>
              <td width="85%">{{ $style['factory_code'] }}</td>
            </tr>
            <tr>
              <td width="15%">CAP Size </td>
              <td width="85%">{{ $style['cap_size']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="15%">CAP Category </td>
              <td width="85%">{{ $style['cap_category']->name ?? '' }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table style="margin-top: 25px;" width="100%">
      <tr style="background-color: #0877BB;">
        <td colspan="3" width="100%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">Process Information</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="30%">Cutting Type </td>
              <td width="70%">{{ $style['cutting_type']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="30%">Weight D </td>
              <td width="70%">{{ $style['weight_d'] }}</td>
            </tr>
            <tr>
              <td width="30%">Weight L </td>
              <td width="70%">{{ $style['weight_l'] }}</td>
            </tr>
            <tr>
              <td width="30%">#of M Length </td>
              <td width="70%">{{ $style['m_length'] }}</td>
            </tr>
            <tr>
              <td width="30%">#of H Length </td>
              <td width="70%">{{ $style['h_length'] }}</td>
            </tr>
            <tr>
              <td width="30%">Spec Number </td>
              <td width="70%">{{ $style['spec_number'] }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="30%">Weft Length </td>
              <td width="70%">{{ $style['weft_length'] }}</td>
            </tr>
            <tr>
              <td width="30%">S-Length </td>
              <td width="70%">{{ $style['s_length'] }}</td>
            </tr>
            <tr>
              <td width="30%">L-Length </td>
              <td width="70%">{{ $style['l_length'] }}</td>
            </tr>
            <tr>
              <td width="30%">Mono Base </td>
              <td width="70%">{{ $style['mono_base'] }}</td>
            </tr>
            <tr>
              <td width="30%">MBC </td>
              <td width="70%">{{ $style['mono_base_calculation'] }}</td>
            </tr>
            <tr>
              <td width="30%">Collection </td>
              <td width="70%">{{ $style['collection']->name ?? '' }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table style="margin-top: 25px;" width="100%">
      <tr style="background-color: #0877BB;">
        <td colspan="3" width="100%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">Finishing Information</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="40%">Finishing Type </td>
              <td width="60%">{{ $style['finishing_type']->name ?? '' }}</td>
            </tr>
            <tr>
              <td width="40%">Packing Method </td>
              <td width="60%">{{ $style['packing_method']->name ?? '' }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
        </td>
      </tr>
    </table>

    @if (count($packing_material_style_details) > 0)
      <table width="100%" cellspacing="0" cellpadding="0" border="0"
        style="margin-top: 25px;font-size: 14px">
        <p style="color: black;font-size: 20px;padding-bottom: 10px"><b>
            Packing Material
          </b>
        </p>




        <tr>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Item Code</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Item Name</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Unit</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Price</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Qty</p>
          </td>
        </tr>
        @foreach ($packing_material_style_details as $packingMaterialStyleDetailIndex => $packingMaterialStyleDetail)
          <tr>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $packingMaterialStyleDetail['code'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">
                      {{ $packingMaterialStyleDetail['name'] ?? '' }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">
                      {{ $packingMaterialStyleDetail['unit']->name ?? '' }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($packingMaterialStyleDetail['price_buy'], 3) }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($packingMaterialStyleDetail['qty'], 3) }}</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        @endforeach
      </table>
    @endif

    @if (count($boms) > 0)
      <table width="100%" cellspacing="0" cellpadding="0" border="0"
        style="margin-top: 25px;font-size: 14px">


        <p style="color: black;font-size: 20px;padding-bottom: 10px"><b>Bills Of Material</b></p>

        <tr>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Item Code</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Item Name</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Unit</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Price</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Consumption</p>
          </td>
        </tr>
        @foreach ($boms as $bomIndex => $bom)
          <tr>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['code'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['name'] ?? '' }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['unit']->name ?? '' }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($bom['price_buy'], 3) }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <tr>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($bom['consumption'], 3) }}</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        @endforeach
      </table>
    @endif
    @if (count($color_groups) > 0)
      <table width="100%" cellspacing="0" cellpadding="0" border="0"
        style="margin-top: 25px;font-size: 14px">
        <tr>

          <p style="color: black;font-size: 20px;padding-bottom: 10px"><b>Color Group</b></p>
        </tr>

        @foreach ($color_groups as $colorIndex => $color)
          @if ($colorIndex != 0)
            <tr>
              <td colspan="3" style="height: 20px"></td>
            </tr>
          @endif
          <tr>
            <td style="background-color: #0877BB; color: white;">
              <p style="color: white;padding-bottom: 10px;font-size: 18px" class="text-center table-header-padding">
                <b>{{ $color['group_name'] }}</b>
              </p>
            </td>
          </tr>
          <tr>
            <td style="background-color: #0877BB; color: white;">
              <p class="table-header-padding">Color Method</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
              <p class="table-header-padding">Color Variant</p>
            </td>
            <td style="background-color: #0877BB; color: white;">
              <p class="table-header-padding">Cap Color</p>
            </td>
          </tr>



          @foreach ($color['color_method'] as $methodIndex => $method)
            <tr>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $method['color_method_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $method['color_variant_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $method['cap_color_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          @endforeach
        @endforeach
      </table>
    @endif
  </div>
</body>

</html>
