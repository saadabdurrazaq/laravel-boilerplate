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
                <p class="header" style="text-align: right;">{{ $header }}</p>
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
                <p><b>PT. DALIM FIDETA KORNESIA</b></p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px; padding-top: 10px">
                  Kawasan Berikat Nusantara Cakung Jl. Belitung Blok D-42, RT.2/RW.1, Sukapura, Kec. Cilincing, Jkt
                  Utara, Daerah Khusus Ibukota Jakarta 14140
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="font-size: 14px; padding-top: 10px">
                  Phone : (021) 44820910
                </p>
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" align="right">
          <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-size: 14px">
            <tr>
              <td>
                <p style="text-align: right;">INGOING DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <td>
                      <p style="text-align: center;">{{ $data['ingoing_date'] }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: right;">INGOING TYPE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $io_type->name ?? '-' }}</p>
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
                <p style="color: white;" class="table-header-padding">Supplier</p>
              </td>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
            <tr>
              <td>
                <p style="color: white;" class="table-header-padding">Pabean Document</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        @if (!$customer)
          <td width="48%">
            <table cellspacing="0" cellpadding="4" width="100%" style="margin-top: 10px">
              <tr>
                <td>
                  <p><b>No Supplier</b></p>
                </td>
              </tr>
            </table>
          </td>
        @else
          <td width="48%">
            <table cellspacing="0" cellpadding="4" width="100%" style="margin-top: 10px">
              <tr>
                <td>
                  <p><b>{{ $customer?->name ?? '-' }}</b></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="font-size: 14px;">{{ $customer?->address ?? '-' }}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="font-size: 14px">Phone : {{ $customer?->phone ?? '-' }}</p>
                </td>
              </tr>
            </table>
          </td>
        @endif
        <td width="2%">
        </td>
        <td width="48%">
          <table width="100%" cellspacing="0" cellpadding="2" border="0"
            style="margin-top: 10px; font-size: 14px">
            <tr>
              <td>
                <p style="text-align: left;">DOCUMENT TYPE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <td>
                      <p style="text-align: center;">{{ $data['doc_type'] ?? '-' }}</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: left;">DOCUMENT NO</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $data['doc_number'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: left;">DOCUMENT DATE</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $data['doc_date'] ?? '-' }}</p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: left;">AJU NO</p>
              </td>
              <td>
                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                  <tr>
                    <p style="text-align: center;">{{ $data['aju_number'] ?? '-' }}</p>
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
          <p class="table-header-padding">DO NO</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">DO Date</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Invoice NO</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Invoice Date</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Warehouse Type</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Currency</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">PPH 23</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">VAT</p>
        </td>
      </tr>
      <tr>
        <td>
          <p class="table-header-padding">{{ $data['do_number'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $data['do_date'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $data['invoice_number'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $data['invoice_date'] ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $warehouse->name ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $currency->name ?? '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $pph?->percentage ? "{$pph->percentage}%" : '-' }}</p>
        </td>
        <td>
          <p class="table-header-padding">{{ $data['use_vat'] ? 'YES' : 'NO' }}</p>
        </td>
      </tr>

    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top: 25px; font-size: 14px">
      <tr>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Reference No</p>
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
          <p class="table-header-padding">Ref Qty</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Qty IN</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Unit Price</p>
        </td>
        <td style="background-color: #0877BB; color: white;">
          <p class="table-header-padding">Amount</p>
        </td>
      </tr>
      @foreach ($detail as $dataDetail)
        <tr>
          <td>
            <p class="table-header-padding">{{ isset($dataDetail['reference_no']) ? $dataDetail['reference_no'] : '-'  }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $dataDetail['style_name'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $dataDetail['item_name'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $dataDetail['unit'] ?? '-' }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ $dataDetail['ref_qty'] ?? $dataDetail['qty'] }}</p>
          </td>
          <td>
            <p class="table-header-padding">{{ formatNumberRupiah($dataDetail['qty'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right">
              {{ formatNumberRupiah($dataDetail['price'], 3) }}</p>
          </td>
          <td>
            <p class="table-header-padding" style="text-align: right">
              {{ formatNumberRupiah($dataDetail['amount'], 3) }}</p>
          </td>
        </tr>
      @endforeach
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 25px; font-size: 14px">
      <tr>
        <td width="48%">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td>
                <p style="color: white;" style="background-color: #0877BB; color: white"
                  class="table-header-padding">Remark</p>
              </td>
            </tr>
            <tr>
              <table cellspacing="0" cellpadding="4" border="1" width="100%">
                <tr>
                  <td>
                    <p style="padding-top: 10px; padding-right: 5px; padding-left: 5px; padding-bottom: 10px">
                      {{ $data['remark'] ?? '-' }}</p>
                  </td>
                </tr>
              </table>
            </tr>
          </table>
        </td>
        <td width="2%">
        </td>
        <td width="48%">
          <table width="80%" cellspacing="0" cellpadding="0" border="0" align="right">
            <tr>
              <td>
                <p style="text-align: left;">Total Amount</p>
              </td>
              <td>
                <table width="100%" cellspacing="2" cellpadding="2" border="1">
                  <tr>
                    <td>
                      <p style="text-align: right; min-width: 150px; padding-left: 8px">{{ $total }}</p>
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
                    <p style="text-align: right; padding-left: 8px">{{ $pph_value }}
                    </p>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <p style="text-align: left; ">VAT</p>
              </td>
              <td>
                <table width="100%" cellspacing="2" cellpadding="2" border="1">
                  <tr>
                    <p style="text-align: right; padding-left: 8px">{{ $total_vat }}
                    </p>
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
                    <p style="text-align: right; color: white; padding-left: 8px">{{ $grand_total }}</p>
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
