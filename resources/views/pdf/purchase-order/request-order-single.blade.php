<!DOCTYPE html>
<html>

<head>
    <title>PDF Request Order</title>
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
    {{-- {{ dd($request) }} --}}

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
        <td width="90%" align="right">
          <table width="100%" cellspacing="0" cellpadding="5" border="0">
            <tr>
              <td>
                <p class="header" style="text-align: right;"><b>REQUEST ORDER</b></p>
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
                <p style="text-align: right;">R/O DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <td>
                      <p style="text-align: center;">{{ $request['request_date'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
                <td>
                  <p style="text-align: right;">Requested</p>
                </td>
                <td>
                  <table width="100%" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                      <td>
                        <p style="text-align: center;">{{ $request['requested'] }}</p>
                      </td>
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
          <p class="table-header-padding">Reference No</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Buyer PO No</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Style Name</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Item Name</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Unit</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Need Qty</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Qty Order</p>
        </td>
        {{-- <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Unit Price</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Amount</p>
        </td> --}}
      </tr>
      @foreach ($request['items'] as $selected_item_index => $item)
        {{-- {{ dd($item) }} --}}
        <tr>

          <td>
            <p class="table-header-padding">{{ $item['sales_order_number'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $item['buyer_po_number'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $item['style_name'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $item['item_name'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $item['unit'] }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($item['need_qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($item['qty'] ?? 0, 3) }}
            </p>
          </td>
          {{-- <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($item['price'] ?? 0, 3) }}
            </p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah(($item['qty'] ?? 0) * ($item['price'] ?? 0), 3) }}</p>
          </td> --}}
        </tr>
      @endforeach
    </table>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 25px">
            <tr>
                <td width="48%">
                    <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
                        <tr>
                            <td>
                                <p style="color: white;" class="table-header-padding">Remark</p>
                            </td>
                        </tr>
                    </table>

                    <table cellspacing="0" cellpadding="4" border="1" width="100%">
                        <tr>
                            <td>
                                <p style="font-size: 14px;">
                                    {{ $request['remark'] ?? '-' }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="48%">

          <div style="display: flex;flex-direction: start;">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
              <tr>
                <td>
                  {{-- <table width="80%" cellspacing="0" cellpadding="0" border="0" align="right">
                    <tr>
                      <td>
                        <p style="text-align: left;">Grand Total</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1"
                          style="background-color:#0877BB">
                          <tr>
                            <p style="text-align: right; color: white; padding-right: 8px">
                              {{ formatNumberRupiah($request['summary']['grand_total'], 3) }}
                            </p>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table> --}}
                  <table cellspacing="0" cellpadding="4" border="0" width="100%">
                    <tr>
                      <td>
                        <p style="font-size: 14px;">
                        </p>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="4" border="0" width="100%">
                    <tr>
                      <td>
                        <p style="font-size: 14px;">
                        </p>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="4" border="0" width="100%">
                    <tr>
                      <td>
                        <p style="font-size: 14px;">
                        </p>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="4" border="0" width="100%">
                    <tr>
                      <td>
                        <p style="font-size: 14px;">
                        </p>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="4" border="0" width="100%">
                    <tr>
                      <td>
                        <p style="font-size: 14px;">
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
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
