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

    <table width="100%" style="border-bottom: 1px solid black;">
      <p class="title">Basic Information</p>
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="50%">Style Code</td>
              <td width="50%">: {{ $style['style_code'] ?? '-' }}</td>
            </tr>
            <tr>
              <td width="50%">Buyer</td>
              <td width="50%">: {{ $style['customer']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">Style Name</td>
              <td width="50%">: {{ $style['style_name'] }}</td>
            </tr>
            <tr>
              <td width="50%">Description</td>
              <td width="50%">: {{ $style['description'] ?? '-' }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table width="100%" style="margin-top: 5px;">
            <tr>
              <td width="50%">Price</td>
              <td width="50%">: {{ $style['price'] }}</td>
            </tr>
            <tr>
              <td width="50%">Unit</td>
              <td width="50%">: {{ $style['unit']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">Collection</td>
              <td width="50%">: {{ $style['collection']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">SKU Buyer</td>
              <td width="50%">: {{ $style['sku_buyer'] ?? '-' }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="100%" style="border-bottom: 1px solid black;">
      <p class="title">CAP Information</p>
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="50%">CAP Type</td>
              <td width="50%">: {{ $style['cap_type']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">Factory Code</td>
              <td width="50%">: {{ $style['factory_code'] }}</td>
            </tr>
            <tr>
              <td width="50%">CAP Size</td>
              <td width="50%">: {{ $style['cap_size']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">CAP Category</td>
              <td width="50%">: {{ $style['cap_category']?->name }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
        </td>
      </tr>
    </table>
    <table width="100%" style="border-bottom: 1px solid black;">
      <p class="title">Process Information</p>
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="50%">Code Cutting Type</td>
              <td width="50%">: {{ $style['cutting_type']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">Weight D</td>
              <td width="50%">: {{ $style['weight_d'] }}</td>
            </tr>
            <tr>
              <td width="50%">Weight L</td>
              <td width="50%">: {{ $style['weight_l'] }}</td>
            </tr>
            <tr>
              <td width="50%">#of M Length</td>
              <td width="50%">: {{ $style['m_length'] }}</td>
            </tr>
            <tr>
              <td width="50%">#of H Length</td>
              <td width="50%">: {{ $style['h_length'] }}</td>
            </tr>
            <tr>
              <td width="50%">Spec Number</td>
              <td width="50%">: {{ $style['spec_number'] }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="50%">Weft Length</td>
              <td width="50%">: {{ $style['weft_length'] }}</td>
            </tr>
            <tr>
              <td width="50%">S-Length</td>
              <td width="50%">: {{ $style['s_length'] }}</td>
            </tr>
            <tr>
              <td width="50%">L-Length</td>
              <td width="50%">: {{ $style['l_length'] }}</td>
            </tr>
            <tr>
              <td width="50%">Mono Base</td>
              <td width="50%">: {{ $style['mono_base'] }}</td>
            </tr>
            <tr>
              <td width="50%">MBC</td>
              <td width="50%">: {{ $style['mono_base_calculation'] }}</td>
            </tr>
            <tr>
              <td width="50%">Collection</td>
              <td width="50%">: {{ $style['collection']?->name }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
      <tr>
        <td>
          <p class="title">Finishing Information</p>
        </td>
      </tr>
    </table>
    <table width="100%" style="border-bottom: 1px solid black;">
      <tr>
        <td width="48%">
          <table width="100%" style="margin-top: 5px">
            <tr>
              <td width="50%">Finishing Type</td>
              <td width="50%">: {{ $style['finishing_type']?->name }}</td>
            </tr>
            <tr>
              <td width="50%">Packing Method</td>
              <td width="50%">: {{ $style['packing_method']?->name }}</td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
        </td>
      </tr>
    </table>

    @if (count($packing_materials) > 0)
      <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
        <tr>
          <td>
            <p class="title" style="padding-bottom: 10px;">Packing Material</p>
          </td>
        </tr>
      </table>
      <table width="100%" cellspacing="0" cellpadding="0" border="1" style=" font-size: 14px">
        <tr>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Item Code</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Item Name</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Unit</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Price</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Qty</p>
          </td>
        </tr>
        @foreach ($packing_materials as $packingMaterialStyleDetailIndex => $packingMaterialStyleDetail)
          <tr>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $packingMaterialStyleDetail['code'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $packingMaterialStyleDetail['name'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">
                      {{ $packingMaterialStyleDetail['unit']['name'] }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">
                      {{ number_format($packingMaterialStyleDetail['price_buy'], 3) }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $packingMaterialStyleDetail['qty'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        @endforeach
      </table>
    @endif
    @if (count($boms) > 0)
      <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
        <tr>
          <td>
            <p class="title" style="padding-bottom: 10px;white-space: nowrap">Bills of Material</p>
          </td>
        </tr>
      </table>
      <table width="100%" cellspacing="0" cellpadding="0" border="1" style="font-size: 14px">
        <tr>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Item Code</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Item Name</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Unit</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Price</p>
          </td>
          <td style="background-color: #0877BB; color: white; white-space: nowrap">
            <p class="table-header-padding">Consumption</p>
          </td>
        </tr>
        @foreach ($boms as $bomIndex => $bom)
          <tr>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['code'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['name'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['unit']['name'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ number_format($bom['price_buy'], 3) }}</p>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <p class="table-header-padding">{{ $bom['consumption'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        @endforeach
      </table>
    @endif
    @if (isset($color_groups))
      @if (count($color_groups) > 0)
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
          <tr>
            <td>
              <p class="title" style="padding-bottom: 10px;white-space: nowrap">Color Group
                [{{ $style['group_name'] }}]
              </p>
            </td>
          </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
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
          @foreach ($color_groups as $colorIndex => $color)
            <tr>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $color['color_method_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $color['color_variant_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                  <tr>
                    <td>
                      <p class="table-header-padding">{{ $color['cap_color_name'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          @endforeach
        </table>
      @endif
    @endif
  </div>
</body>

</html>
