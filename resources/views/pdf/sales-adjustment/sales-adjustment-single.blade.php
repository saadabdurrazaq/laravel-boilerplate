<!DOCTYPE html>
<html>

<head>
    <title>PDF Sales Adjustment</title>
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
                                <p class="header" style="text-align: right;"><b>SALES ADJUSTMENT</b></p>
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
                                <p><b>{{ $company_profile->name }}</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 14px; padding-top: 10px">
                                    {{ $company_profile->address }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 14px; padding-top: 10px">
                                    Phone : {{ $company_profile->phone }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width=50%>
                    <table width="100%" cellspacing="0" cellpadding="5" border="0"
                        style="font-size: 14px;margin-top:10px">
                        <tr>
                            <td>
                                <p style="text-align: right;">ADJUSTMENT NO</p>
                            </td>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                                    <tr>
                                        <td>
                                            <p style="text-align: left;margin-left:10px">{{ $adjustment_no }} </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: right;">PAYMENT DATE</p>
                            </td>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="1" border="1">
                                    <tr>
                                        <p style="text-align: left;margin-left:10px">{{ $payment_date }} </p>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>
        </table>



        <table width="100%" cellspacing="0" cellpadding="0" border="0"
            style="margin-top: 25px;margin-bottom: 25px">
            <tr>
                <td width="100%">
                    <table cellspacing="0" cellpadding="4" width="100%" style="background-color: #0877BB;">
                        <tr>
                            <td>
                                <p style="color: white;" class="table-header-padding">Buyer</p>
                            </td>
                        </tr>
                    </table>
                </td>


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
                                            <p><b>{{ $customer->name }}</b></p>
                                        </td>
                                    </tr>
                                    @if ($customer->address != null)
                                        <tr>
                                            <td>
                                                <p style="font-size: 14px; padding-top: 10px">
                                                    {{ $customer->address }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($customer->bank_name != null)
                                        <tr>
                                            <td>
                                                <p style="font-size: 14px; padding-top: 10px">
                                                    Bank : {{ $customer->bank_name }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($customer->phone != null)
                                        <tr>
                                            <td>
                                                <p style="font-size: 14px; padding-top: 10px">
                                                    Phone : {{ $customer->phone }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="2%">
                </td>
            </tr>
        </table>



        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 14px">
            <tr>

                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Admin Bank</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Rounding</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Currency</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Exchange Rate</p>
                </td>
            </tr>

            <tr>

                <td width="25%">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1">
                        <tr>
                            <td>
                                <p class="table-header-padding">{{ formatNumberRupiah($admin_bank, 3) }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1">
                        <tr>
                            <td>
                                <p class="table-header-padding">{{ formatNumberRupiah($rounding, 3) }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1">
                        <tr>
                            <td>
                                <p class="table-header-padding">{{ $currency->name }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1">
                        <tr>
                            <td>
                                <p class="table-header-padding">
                                    {{ formatNumberRupiah($exchange_rate, 3) }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="1"
            style="margin-top: 25px; font-size: 14px">
            <tr>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Invoice No</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Invoice Date</p>
                </td>

                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Currency</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Exchange Rate</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Invoice Amount</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Invoice IDR</p>
                </td>
                <td style="background-color: #0877BB; color: white;">
                    <p class="table-header-padding">Adjustment Amount</p>
                </td>
            </tr>
            @foreach ($sales_invoice as $index => $invoice_list)
                <tr>
                    <td>
                        <p class="table-header-padding">{{ $invoice_list['invoice_no'] }}</p>
                    </td>
                    <td>
                        <p class="table-header-padding">{{ $invoice_list['invoice_date'] }}</p>
                    </td>

                    <td>
                        <p class="table-header-padding">{{ $invoice_list['currency_name'] }}</p>
                    </td>
                    <td>
                        <p class="table-header-padding" style="text-align: right !important;">
                            {{ formatNumberRupiah($invoice_list['exchange_rate'], 3) }}
                        </p>
                    </td>
                    <td>
                        <p class="table-header-padding" style="text-align: right !important;">
                            {{ formatNumberRupiah($invoice_list['grand_total'] * $invoice_list['exchange_rate'], 3) }}
                        </p>
                    </td>
                    <td>
                        <p class="table-header-padding" style="text-align: right !important;">
                            {{ formatNumberRupiah($invoice_list['grand_total'], 3) }}
                        </p>
                    </td>
                    <td>
                        <p class="table-header-padding" style="text-align: right !important;">
                            {{ formatNumberRupiah($invoice_list['sales_adjustment_amount'], 3) }}
                        </p>
                    </td>
                </tr>
            @endforeach
        </table>


        <table width="100%" cellspacing="0" cellpadding="0" border="0"
            style="margin-top: 25px; font-size: 14px">
            <tr>
                <td width="48%">
                    <table cellspacing="0" cellpadding="0" width="100%">
                        <table width="90%" cellspacing="0" cellpadding="0" border="0" align="left">
                            <tr>
                                <td>
                                    <p style="text-align: left;">Total Adjustment IDR</p>
                                </td>
                                <td>
                                    <table width="100%" cellspacing="2" cellpadding="2" border="1">
                                        <tr>
                                            <td>
                                                <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                                    {{ formatNumberRupiah($total_adjustment_idr, 3) }}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="text-align: left;">Total Invoice IDR</p>
                                </td>
                                <td>
                                    <table width="100%" cellspacing="2" cellpadding="2" border="1">
                                        <tr>
                                            <td>
                                                <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                                    {{ formatNumberRupiah($total_invoice_idr, 3) }}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="text-align: left;">Foreign Exchange Profit</p>
                                </td>
                                <td>
                                    <table width="100%" cellspacing="2" cellpadding="2" border="1">
                                        <tr>
                                            <td>
                                                <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                                    {{ formatNumberRupiah($foreign_exc_profit, 3) }}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="text-align: left;">Foreign Exchange Loss</p>
                                </td>
                                <td>
                                    <table width="100%" cellspacing="2" cellpadding="2" border="1">
                                        <tr>
                                            <p style="text-align: right;  padding-right: 8px">
                                                {{ formatNumberRupiah($foreign_exc_loss, 3) }}

                                            </p>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </table>
                </td>
                <td width="50%">
                    <table width="80%" cellspacing="0" cellpadding="0" border="0" align="right">
                        <tr>
                            <td>
                                <p style="text-align: left;">Total Adjustment</p>
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
                                                {{ formatNumberRupiah($total_adjustment_amount, 3) }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: left;">Admin Bank</p>
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
                                                {{ formatNumberRupiah($admin_bank, 3) }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: left;">Rounding</p>
                            </td>
                            <td>
                                <table width="100%" cellspacing="2" cellpadding="2" border="1">
                                    <tr>
                                        <td>
                                            <p style="text-align: left;padding-left: 8px">
                                                @if ($rounding >= 0)
                                                    +
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: right; min-width: 150px; padding-right: 8px">
                                                {{ formatNumberRupiah(abs($rounding), 3) }}
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
