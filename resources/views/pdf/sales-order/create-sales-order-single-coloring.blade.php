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
                <p class="header" style="text-align: right;"><b>SALES ORDER</b></p>
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
                <p style="text-align: right;">BUYER PO NO</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <td>
                      <p style="text-align: center;">{{ $buyer_po_number }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: right;">ORDER DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $order_date }}</p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: right;">ORDER TYPE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $order_type['name'] }}</p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: right;">SHIPPING DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $shipping_date }}</p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: right;">STATUS</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center; width: 100%">{{ $status }}</p>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>



    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 25px;">
      <tr>
        <td width="48%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">Buyer</p>
              </td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
      </tr>
      <tr>
        <td width="48%">
          <table cellspacing="0" cellpadding="4" width="100%" style="margin-top: 10px">
            <tr>
              <td width="50%">
                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td>
                      <p><b>{{ $customer['name'] }}</b></p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="font-size: 14px; padding-top: 10px">
                        {{ $shipping_destination }}
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="font-size: 14px; padding-top: 10px">
                        Phone : {{ $customer['phone'] }}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>

      </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top: 25px; font-size: 14px">
      <tr>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Shipping Term</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Payment Term</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Currency</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Exchange Rate</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Discount</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">PPH23</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">VAT</p>
        </td>
      </tr>
      <tr>
        <td>
          <p class="table-header-padding">{{ $shipping_term['name'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $payment_term['name'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $currency['name'] }}</p>
        </td>
        <td>
          <p class="table-header-padding">-</p>
        </td>
        <td>
          <p class="table-header-padding" style="text-align: right !important;">
            {{ formatNumberRupiah($total_discount, 3) }}</p>
        </td>
        <td>
          <p class="table-header-padding">-</p>
        </td>
        <td>
          <p class="table-header-padding">-</p>
        </td>
      </tr>
    </table>
    @foreach ($styles as $style_index => $style)
      <table width="100%" cellspacing="0" cellpadding="0" border="1"
        style="margin-top: 25px; font-size: 14px">
        <tr>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Style Code</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Style Name</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Factory Code</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Unit</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Qty</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Discount</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">FOB</p>
          </td>
          <td style="background-color: #0877BB; color: white;">
            <p class="table-header-padding">Agent</p>
          </td>
        </tr>




        <tr>
          <td>
            <p class="table-header-padding">{{ $style['style_code'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['style_name'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['factory_code'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $style['unit_name'] }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">{{ $style['qty'] }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ $style['discount'] }} %
            </p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($style['high_amount'], 3) }}
            </p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right !important;">
              {{ formatNumberRupiah($style['amount'], 3) }}
            </p>
          </td>
        </tr>
        <!-- Color method table -->
        <tr>
          <td colspan="8">
            <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px">
              <tr>
                <th style="background-color: #0877BB; color: white; border: none">
                  <p class="table-header-padding">Color Method</p>
                </th>
                <th style="background-color: #0877BB; color: white; border: none">
                  <p class="table-header-padding">Color Name</p>
                </th>
                <th style="background-color: #0877BB; color: white; border: none">
                  <p class="table-header-padding">Qty</p>
                </th>
                <th style="background-color: #0877BB; color: white; border: none">
                  <p class="table-header-padding">Total FOB Price</p>
                </th>
                <th style="background-color: #0877BB; color: white; border: none">
                  <p class="table-header-padding">Total Agent Price</p>
                </th>
              </tr>
              @foreach ($style['color_methods'] as $cm_index => $colorMethod)
                <tr style="background-color: white; color: black; border: none">
                  <td>
                    <p class="table-header-padding">{{ $colorMethod['color_method_name'] }}</p>
                  </td>
                  <td>
                    <p class="table-header-padding">

                      {{ $colorMethod['color_variant_name'] }} ({{ $colorMethod['qty'] }})


                    </p>
                  </td>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">{{ $colorMethod['qty'] }}
                    </p>
                  </td>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($colorMethod['total_high_price'], 3) }}</p>
                  </td>
                  <td>
                    <p class="table-header-padding" style="text-align: right !important;">
                      {{ formatNumberRupiah($colorMethod['total_low_price'], 3) }}</p>
                  </td>
                </tr>
              @endforeach
            </table>
          </td>
        </tr>
        <!-- End of color method table -->
      </table>
    @endforeach
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
                  {{ $remark }}
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
                  <table width="80%" cellspacing="0" cellpadding="0" border="0" align="right">
                    <tr>
                      <td>
                        <p style="text-align: left;">Total Amount</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1">
                          <tr>
                            <td>
                                <p style="text-align: left;padding-left: 8px">
                                    +
                                </p>
                            </td>
                            <td>
                              <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                {{ formatNumberRupiah($total_amount, 3) }}
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p style="text-align: left;">Total Discount</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1">
                          <tr>
                            <td>
                                <p style="text-align: left;padding-left: 8px">
                                 -
                                </p>
                            </td>
                            <td>
                              <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                {{ formatNumberRupiah($total_discount, 3) }}
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p style="text-align: left;">Total PPH</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1">
                          <tr>
                            <td>
                                <p style="text-align: left;padding-left: 8px">
                                    +
                                </p>
                            </td>
                            <td>
                              <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                -
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p style="text-align: left;">Total VAT</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1">
                          <tr>
                            <td>
                                <p style="text-align: left;padding-left: 8px">
                                    +
                                </p>
                            </td>
                            <td>
                              <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                -
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p style="text-align: left;">Grand Total</p>
                      </td>
                      <td>
                        <table width="100%" cellspacing="2" cellpadding="2" border="1"
                          style="background-color:#0877BB">
                          <tr>
                            <p style="text-align: right; color: white; padding-right: 8px">
                              {{ formatNumberRupiah($grand_total, 3) }}
                            </p>
                          </tr>
                        </table>
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
            <td width="50%" style="border: 1px solid black;text-align:center ">
                Staff
            </td>
            <td width="50%" style="border: 1px solid black;text-align:center ">
                Manager
            </td>
            <td width="50%" style="border: 1px solid black;text-align:center ">
                Director
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
        </tr>
    </table>
  </div>
</body>

</html>
