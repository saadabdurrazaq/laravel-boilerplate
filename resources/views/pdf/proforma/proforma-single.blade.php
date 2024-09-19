<!DOCTYPE html>
<html>

<head>
  <title>PDF Sales Order</title>
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

  <div style="page-break-inside: avoid !important;">
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
                <p class="header" style="text-align: right;"><b>Proforma Invoice</b></p>
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
                <p><b>{{ $agent?->name ?? '-' }}</b></p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  {{ $agent?->address ?? '-' }}
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  Phone : {{ $agent?->phone ?? '-' }}
                </p>
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" align="right">
          <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-size: 14px">

            <tr>
              <td>
                <p style="text-align: right;">INVOICE NO</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $requests['invoice_no'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <p style="text-align: right;">INVOICE DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $requests['invoice_date'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <p style="text-align: right;">DELIVERY DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $shipping_date ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 15px">
      <tr>
        <td width="100%" style="background-color: #0877BB;  font-weight: bold">
          <p style="color: white;" class="table-header-padding">Buyer</p>
        </td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td width="48%" style="display: flex; flex-direction: start; padding: 8px">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td>
                <p><b>{{ $customer?->name ?? '-' }}</b></p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  {{ $customer?->address ?? '-' }}
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  Phone : {{ $customer?->phone ?? '-' }}
                </p>
              </td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%" style="display: flex; flex-direction: start; padding: 8px">
          <p style="font-size: 14px">
            Attn : {{ $customer?->pic ?? '-' }}
          </p>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top: 5px; font-size: 14px">
      <tr>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">PO NO</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Style Name</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Factory Code</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">Qty</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">U/Price</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">Amount</p>
        </td>
      </tr>
      @foreach ($requests['sales_has_styles'] ?? [] as $style_index => $style)
        <tr>
          <td>
            <p class="table-header-padding">{{ $style['buyer_po_number'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['style_name'] }} <span
                style="font-size: 12px;">{{ $style['rule_description'] ?? '' }}</span></p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['factory_code'] }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($style['qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ $currency }}{{ formatNumberRupiah($style['tmp_amount'] / $style['qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ $currency }}{{ formatNumberRupiah($style['tmp_amount'], 3) }}
            </p>
          </td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3">
          <p class="table-header-padding" style="text-align: center !important; font-weight: bold;">
            Grand Total
          </p>
        </td>
        <td>
          <p class="table-header-padding" style="text-align: right !important;">
            {{ formatNumberRupiah($requests['qty'] ?? 0, 3) }}</p>
        </td>
        <td colspan="2">
          <p class="table-header-padding" style="text-align: right !important;">
            {{ $currency }}{{ formatNumberRupiah($requests['grand_total'] ?? 0, 3) }}
          </p>
        </td>
      </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 15px; font-size:12px">
      <tr>
        <td width="48%" style="background-color: #0877BB;  font-weight: bold">
          <p style="color: white;" class="table-header-padding">Remark</p>
        </td>
        <td width="2%">
        </td>
        <td width="48%" style="background-color: #0877BB;  font-weight: bold">
          <p style="color: white;" class="table-header-padding">Wire Transfer Information</p>
        </td>
      </tr>
      <tr>
        <td width="48%" style="display: flex; flex-direction: start; padding: 8px">
          {{ $requests['remark'] ?? '-' }}
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table cellspacing="0" cellpadding="4" border="1" width="100%">
            <tr>
              <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="right">
                  <tr>
                    <td>
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">Bank</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->bank_name ?? '-' }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">Tel</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->phone ?? '-' }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td style="display: flex; flex-direction: start;">
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">Address</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->address ?? '-' }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">Swift Code</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->swift_code ?? '-' }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">Beneficiary</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->name ?? '-' }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="text-align: left; white-space: nowrap; padding-right: 8px;">USD Account</p>
                    </td>
                    <td>
                      <p style="min-width: 150px; padding-right: 8px">
                        {{ $agent?->bank_account_number ?? '-' }}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
      <tr>
        <td colspan="1" style="border: 0px solid black;">
          <p style="margin-top: 5px;margin-bottom: 5px"> <b>Signature</b></p>
        </td>
      </tr>
      <tr height="50px">
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
      </tr>
      <tr style="height: 200px;">
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
      </tr>
    </table>

  </div>

  <div style="page-break-inside: avoid !important;">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td width="10%">
          <table cellspacing="5" cellpadding="0" width="100%">
            <tr>
              <td>

              </td>
            </tr>
          </table>
        </td>
        <td width="50%" align="right">
          <table width="100%" cellspacing="0" cellpadding="5" border="0">
            <tr>
              <td>
                <p class="header" style="text-align: right;"><b>Purchase Order Confirmation Sheet</b></p>
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
                <p><b>{{ $agent?->name ?? '-' }}</b></p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  {{ $agent?->address ?? '-' }}
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px">
                  Phone : {{ $agent?->phone ?? '-' }}
                </p>
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" align="right">
          <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-size: 14px">

            <tr>
              <td>
                <p style="text-align: right;">OCS NO</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $requests['invoice_no'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <p style="text-align: right;">OCS DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $requests['invoice_sheet_date'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <p style="text-align: right;">DELIVERY DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $shipping_date ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td>
          <p style="font-size: 14px; padding-top: 10px">
            TO : {{ $company_profile?->name ?? '-' }}
          </p>
        </td>
      </tr>
      <tr>
        <td width="50%">
          <p style="font-size: 14px; padding-top: 5px">
            CUSTOMER : {{ $customer?->name ?? '-' }}
          </p>
        </td>
        <td width="50%" align="right">
          <p style="font-size: 14px; padding-top: 5px">
            DESTINATION : {{ $customer?->address ?? '-' }}
          </p>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top: 5px; font-size: 14px">
      <tr style="font-weigth: bold">
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">PO NO</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Style Name</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Factory Code</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">Qty</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">U/Price</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding" style="text-align: right !important;">Amount</p>
        </td>
      </tr>
      @foreach ($requests['sales_has_styles'] ?? [] as $style_index => $style)
        <tr>
          <td>
            <p class="table-header-padding">{{ $style['buyer_po_number'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['style_name'] }} <span
                style="font-size: 10px;">{{ $style['rule_description'] ?? '' }}</span></p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['factory_code'] }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($style['qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ $currency }}{{ formatNumberRupiah($style['tmp_high_amount'] / $style['qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ $currency }}{{ formatNumberRupiah($style['tmp_high_amount'], 3) }}
            </p>
          </td>
        </tr>
      @endforeach

      <tr>
        <td colspan="3">
          <p class="table-header-padding" style="text-align: center !important; font-weight: bold;">
            Grand Total
          </p>
        </td>
        <td>
          <p class="table-header-padding" style="text-align: right !important;">
            {{ formatNumberRupiah($requests['qty'] ?? 0, 3) }}</p>
        </td>
        <td colspan="2">
          <p class="table-header-padding" style="text-align: right !important;">
            {{ $currency }}{{ formatNumberRupiah($requests['grand_total_sheet'] ?? 0, 3) }}
          </p>
        </td>
      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
      <tr>
        <td colspan="1" style="border: 0px solid black;">
          <p style="margin-top: 5px;margin-bottom: 5px"> <b>Signature</b></p>
        </td>
      </tr>
      <tr height="50px">
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black;">
          &nbsp;
        </td>
      </tr>
      <tr style="height: 200px;">
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
        <td width="50%" style="border: 1px solid black; height: 70px;">
          &nbsp;
        </td>
      </tr>
    </table>

  </div>
</body>

</html>
