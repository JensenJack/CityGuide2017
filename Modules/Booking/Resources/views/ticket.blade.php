<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>{{ app_name() }} - Final E-Ticket</title>
    <style type="text/css">

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        td, th {
            border-collapse: collapse;
        }

        a {
            text-decoration: none;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        @font-face {
            font-family: "Zawgyi-One";
            src: local("Zawgyi-One"), url({{ public_path('build/fonts/zawgyione.eot') }});
            src: local("Zawgyi-One"), url({{ public_path('build/fonts/zawgyione.eot#iefix') }}) format("embedded-opentype"),
            url({{ public_path('build/fonts/zawgyione.woff') }}) format("woff"),
            url({{ public_path('build/fonts/zawgyione.ttf') }}) format("truetype"),
            url({{ public_path('build/fonts/zawgyione.svg#zawgyi-oneregular') }}) format("svg");
        }

        body {
            font-family: 'Zawgyi-One', 'roboto', 'arial';
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
            margin: 0 !important;
            padding: 0 !important;
            min-width: 100% !important;
        }

        @media only screen and (max-width: 479px) {
            body {
                min-width: 100% !important;
                font-family: 'Zawgyi-One', 'roboto', 'arial';
            }

            th[class=stack] {
                display: block !important;
                width: 300px !important;
                border: 0 !important;
                height: auto !important;
            }

            table[class=table600Logo] {
                width: 300px !important;
            }

            table[class=centerize] {
                margin: 0 auto 0 auto !important;
                border-bottom-width: 2px !important;
                border-bottom-style: solid !important;
            }

            table[class=table600Menu] {
                width: 300px !important;
            }

            table[class=table600Menu] td {
                height: 20px !important;
            }

            td[class=AnnouncementTD] {
                width: 300px !important;
                text-align: center !important;
                font-size: 17px !important;
            }

            td[class=table600st] {
                width: 300px !important;
                min-width: 300px !important;
                height: 20px !important;
            }

            td[class=header2TD] {
                height: 0 !important;
                font-size: 12px !important;
            }

            td[class=header5TD] {
                font-size: 12px !important;
                font-weight: lighter !important;
            }

            table[class=table600] {
                width: 300px !important;
            }

            table[class=table6003] {
                width: 300px !important;
                border-bottom-style: solid !important;
                border-bottom-width: 1px !important;
            }

            table[class=table600Min] {
                width: 300px !important;
                min-width: 300px !important;
            }

            td[class=wz] {
                height: 10px !important;
            }

            td[class=wz2] {
                width: 10px !important;
                height: 10px !important;
            }

            td[class=RegularTextTD] {
                width: 240px !important;
                height: 0 !important;
            }

            td[class=RegularText5TD] {
                font-size: 13px !important;
            }

            td[class=esFrMb] {
                width: 0 !important;
                height: 0 !important;
                display: none !important;
            }

            table[class=tableTxt] {
                width: 240px !important;
            }

            td[class=vrtclAlgn] {
                height: 30px !important;
            }

            td[class=va2] {
                height: 20px !important;
            }

            th[class=stack2] {
                width: 100px !important;
            }

            table[class=table60032] {
                width: 98px !important;
            }

            th[class=stack3] {
                width: 66px !important;
            }

            table[class=table60033] {
                width: 64px !important;
            }

            th[class=stack4] {
                width: 166px !important;
            }

            table[class=table60034] {
                width: 164px !important;
            }

            td[class=TDtable60034] {
                width: 162px !important;
            }

            td[class=RegularText4TD] {
                font-size: 13px !important;
                font-weight: lighter !important;
            }
        }
    </style>
</head>
<body style="font-family: 'Zawgyi-One', 'roboto', 'arial';background-color: #fdfdfd;margin: 0 auto;padding: 0 !important;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;-webkit-font-smoothing: antialiased;min-width: 100% !important;" onload="window.print()">
<center>

    <!--LOGO SECTION MODULE -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" height="30" class="table600st" style="min-width:668px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min"
                       bgcolor="#384855" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   bgcolor="#fdfdfd" class="table600"
                                   style="border-bottom:1px solid #dde5f1; border-radius:6px 6px 0 0;">
                                <tr>
                                    <td width="629" class="table600st" align="left" style="min-width:629px;">
                                        <table width="260" align="left" cellpadding="0" cellspacing="0" border="0"
                                               class="table600Logo">
                                            <tr>
                                                <!--LOGO IMAGE'S WIDTH MUST BE MAX 200px OR LOWER-->
                                                <!--HEIGHT MUST BE 100 px-->
                                                <!--Open the "logo.PSD" in photoshop-->
                                                <!--Add your logo, center it VERTICALLY in PSD as I did by default (this ensures to have some space at top and bottom as A padding) and save as JPG or PNG -->
                                                <!--FOR BEST RESULTS:MAKE YOUR IMAGE'S WIDTH JUST AS WIDE AS YOUR LOGO (NO SPACING at both LEFT and RIGHT sides at PSD File)-->
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" border="0" class="centerize"
                                                           style="border-bottom-color:#ff675f;">
                                                        <tr>
                                                            <td width="30" class="esFrMb"></td>
                                                            <td align="center" style="line-height:1px;"><a href="#"
                                                                                                           target="_blank"
                                                                                                           style="text-decoration: none;"><img
                                                                            src="{{ config('app.app_setting.main_logo') }}"
                                                                            style="display: block;text-decoration: none;border: none;"
                                                                            alt="Logo Image" border="0" align="top"
                                                                            hspace="0" vspace="0"></a></td>
                                                            <td width="30" class="esFrMb"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table width="348" align="right" cellpadding="0" cellspacing="0" border="0"
                                               class="table600Menu">
                                            <tr>
                                                <td colspan="2" height="10" style="font-size:0;line-height:0;">
                                                    &nbsp;</td>
                                            </tr>
                                            <tr>
                                                <!-- INVOICE TEXT (or any text) -->
                                                <td width="318" valign="middle" align="right" height="80"
                                                    class="AnnouncementTD"
                                                    style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 18px;text-align: right;line-height: 150%;font-weight: bold;letter-spacing: 2px;">
                                                    Final Hotel Ticket
                                                </td>
                                                <td width="30" class="esFrMb"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="10" style="font-size:0;line-height:0;">
                                                    &nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->

    <!--2 COLUMNS == INVOICE CREDENTIALS MODULE == 2 (20 x 20)  ICONS ==-->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   class="table600Min" style="min-width:628px;">
                                <tr>
                                    <td class="table600st" style="min-width:628px;">
                                        <table width="629" bgcolor="#fdfdfd" align="left" cellpadding="0"
                                               cellspacing="0" border="0" class="table600">
                                            <tr>
                                                <td>
                                                    <table align="center" cellpadding="0" cellspacing="0"
                                                           bgcolor="#fdfdfd" border="0"
                                                           style=" border-bottom:1px solid #dde5f1;">
                                                        <tr>
                                                            <th width="314" class="stack"
                                                                style="margin:0; padding:0;vertical-align:top;">
                                                                <table width="314" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table6003"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="30" class="wz"></td>
                                                                        <td valign="top" align="center">
                                                                            <table width="252" align="left"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   border="0" class="tableTxt">
                                                                                <tr>
                                                                                    <!--NAME SECTION-->
                                                                                    <td width="179" valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">
                                                                                        Your Myanmar Hotel e-Ticket
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="10"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--NAME SECTION-->
                                                                                    <td width="179" valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">
                                                                                        <?php

                                                                                        $cname = $booking->guest_name;

                                                                                        $ref = $booking->booking_ref;
                                                                                        ?>
                                                                                        Name
                                                                                        : {{ $booking->check_in_name.'('.$booking->guest_type.')' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="10"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--NAME SECTION-->
                                                                                    <td width="179" valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">
                                                                                        NRC No
                                                                                        : {{ $booking->guest_nrc }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="10"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--NAME SECTION-->
                                                                                    <td width="179" valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">
                                                                                        Room
                                                                                        : {{$booking->room->name}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="10"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--NAME SECTION-->
                                                                                    <td width="179" valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">
                                                                                        Hotel&nbsp;&nbsp;&nbsp; : <span
                                                                                                style="background-color:#FFFF00;">{{ $booking->hotels->name }}</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="10"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>

                                                                            </table>
                                                                        </td>
                                                                        <td width="30" class="wz"></td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->

    <!--== 3 COLUMNS MODULE = INVOICE NO == INVOICE DATE == INVOICE TOTAL ==-->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   class="table600Min" style="min-width:629px;">
                                <tr>
                                    <td class="table600st" style="min-width:629px;">
                                        <table width="629" bgcolor="#fdfdfd" align="left" cellpadding="0"
                                               cellspacing="0" border="0" class="table600">
                                            <tr>
                                                <td align="left">
                                                    <table align="center" bgcolor="#fdfdfd" cellpadding="0"
                                                           cellspacing="0" border="0"
                                                           style="border-bottom:1px solid #dde5f1;">
                                                        <tr>
                                                            <th width="209" class="stack"
                                                                style="margin:0; padding:0;vertical-align:top;">
                                                                <table width="209" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table6003"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="30" class="wz"></td>
                                                                        <td valign="top" align="center">
                                                                            <table width="145" align="left"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   border="0" class="tableTxt">
                                                                                <tr>
                                                                                    <!--ICON image here 20 x 20-->
                                                                                    <td rowspan="2" width="25"
                                                                                        align="center" valign="top"
                                                                                        style="line-height:1px;">
                                                                                    </td>
                                                                                    <td rowspan="2" width="14"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                    <!--Invoice No-->
                                                                                    <td valign="top" class="header2TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;">
                                                                                        Ticket No
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--Number-->
                                                                                    <td valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">{{$ref}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td width="30" class="wz"></td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            <th width="209" class="stack"
                                                                style="border-left:1px solid #dde5f1;margin:0; padding:0;vertical-align:top;">
                                                                <table width="209" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table6003"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="30" class="wz"></td>
                                                                        <td valign="top" align="center">
                                                                            <table width="145" align="left"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   border="0" class="tableTxt">
                                                                                <tr>
                                                                                    <!--ICON image here 20 x 20-->
                                                                                    <td rowspan="2" width="25"
                                                                                        align="center" valign="top"
                                                                                        style="line-height:1px;">
                                                                                    </td>
                                                                                    <td rowspan="2" width="14"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                    <!--Invoice Date-->
                                                                                    <td valign="top" class="header2TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;">
                                                                                        Check In Date
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--Date-->
                                                                                    <td valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">{{ date(config('app.app_setting.date_format'),strtotime($booking->check_in_date)) }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--ICON image here 20 x 20-->
                                                                                    <td rowspan="2" width="25"
                                                                                        align="center" valign="top"
                                                                                        style="line-height:1px;">
                                                                                    </td>
                                                                                    <td rowspan="2" width="14"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                    <!--Invoice Date-->
                                                                                    <td valign="top" class="header2TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;">
                                                                                        Check Out Date
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--Date-->
                                                                                    <td valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">{{ date(config('app.app_setting.date_format'),strtotime($booking->check_out_date)) }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td width="30" class="wz"></td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            <th width="209" class="stack"
                                                                style="border-left:1px solid #dde5f1;margin:0; padding:0;vertical-align:top;">
                                                                <table width="209" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table600"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="30" class="wz"></td>
                                                                        <td valign="top" align="center">
                                                                            <table width="145" align="left"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   border="0" class="tableTxt">
                                                                                <tr>
                                                                                    <!--ICON image 20 x 20-->
                                                                                    <td rowspan="2" width="25"
                                                                                        align="center" valign="top"
                                                                                        style="line-height:1px;">
                                                                                    </td>
                                                                                    <td rowspan="2" width="14"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                    <!--Invoice Total-->
                                                                                    <td valign="top" class="header2TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;">
                                                                                        Booked By
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <!--Invoice Total-->
                                                                                    <td valign="top"
                                                                                        class="RegularText4TD"
                                                                                        align="left"
                                                                                        style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;">{{$cname}}
                                                                                        </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25"
                                                                                        style="font-size:0;line-height:0;">
                                                                                        &nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td width="30" class="wz"></td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->

    <!-- 1 COLUMN === YOUR PAYMENT IS PROCESSING TEXT MODULE -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" bgcolor="#fdfdfd" align="center" cellpadding="0" cellspacing="0"
                                   border="0" class="table600Min" style="min-width:629px;">
                                <tr>
                                    <td class="table600st" style="min-width:629px;">
                                        <table width="629" align="left" cellpadding="0" cellspacing="0" border="0"
                                               class="table600" style="border-bottom:1px solid #dde5f1;">
                                            <tr>
                                                <td align="center">
                                                    <table cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td align="center">
                                                                <table width="629" cellpadding="0" cellspacing="0"
                                                                       border="0" class="table600">
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;"
                                                                            class="vrtclAlgn2">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3" height="25"
                                                                            style="font-size:0;line-height:0;"
                                                                            class="vrtclAlgn">&nbsp;</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->


    <!--== 4 COLUMNS MODULE == MAIN INVOICE CAPTIONS == DESCRIPTION == QUANTITY == PRICE == TEXT ==-->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   class="table600Min" style="min-width:629px;">
                                <tr>
                                    <td class="table600st" style="min-width:629px;">
                                        <table width="629" align="left" cellpadding="0" cellspacing="0"
                                               bgcolor="#000000" border="0" class="table600">
                                            <tr>
                                                {{-- <td align="left">
                                                    <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                           style="border-bottom:1px solid #dde5f1;">
                                                        <tr>
                                                            
                                                            <th width="109" class="stack3"
                                                                style="border-left:1px solid #dde5f1;margin:0; padding:0;vertical-align:top;">
                                                                <table width="109" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table60033"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>                                  --}}                                       
                                                                        <!-- PRICE TEXT -->
                                                                        <td class="header5TD"
                                                                            style="color: #ffffff;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 15px;text-align: center;line-height: 27px;font-weight: bold;">
                                                                            VOUCHER NO.
                                                                        </td>                                                                        
                                                                    {{-- </tr>
                                                                    <tr>
                                                                        <td colspan="3" height="20"
                                                                            style="font-size:0;line-height:0;"
                                                                            class="va2">&nbsp;</td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            
                                                        </tr>
                                                    </table>
                                                </td> --}}
                                            </tr>                                          

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->


    <!-- 4 COLUMNS MODULE == ITEMS  DETAILS == NAME, PRICE, QUANTITY, TOTAL -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   class="table600Min" style="min-width:629px;">
                                <tr>
                                    <td class="table600st" style="min-width:629px;">
                                        <table width="629" align="left" cellpadding="0" cellspacing="0"
                                               bgcolor="#eff3f7" border="0" class="table600">
                                            <tr>
                                                {{-- <td align="left">
                                                    <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                           style="border-bottom:1px solid #dde5f1;">
                                                        <tr>
                                                            
                                                            <th width="109" class="stack3"
                                                                style="border-left:1px solid #dde5f1;margin:0; padding:0;">
                                                                <table width="109" align="center" cellpadding="0"
                                                                       cellspacing="0" border="0" class="table60033"
                                                                       style="border-bottom-color:#dde5f1;">
                                                                    <tr>
                                                                        <td colspan="3" height="20"
                                                                            style="font-size:0;line-height:0;"
                                                                            class="va2">&nbsp;</td>
                                                                    </tr>
                                                                    <tr> --}}
                                                                        
                                                                        <!-- PRICE -->
                                                                        <td class="RegularText5TD"
                                                                            style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;">
                                                                           @if ($booking_email['voucher_no'])
                                                                                {!!   $booking_email['voucher_no']  !!}
                                                                           @else {
                                                                                Comming Up
                                                                            }
                                                                           @endif
                                                                        </td>
                                                                        
                                                                    {{-- </tr>
                                                                    <tr>
                                                                        <td colspan="3" height="20"
                                                                            style="font-size:0;line-height:0;"
                                                                            class="va2">&nbsp;</td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            
                                                        </tr>
                                                    </table>
                                                </td> --}}
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->


    <!-- 1 COLUMNS MODULE === FINAL NOTES, ACCEPTED PAYMENT OPTIONS ETC. -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" border="0"
                                   class="table600Min" style="min-width:629px;">
                                <tr>
                                    <td class="table600st" style="min-width:629px;">
                                        <table width="629" bgcolor="#fdfdfd" align="left" cellpadding="0"
                                               cellspacing="0" border="0" class="table600"
                                               style="border-radius:0 0 6px 6px;">
                                            <tr>
                                                <td>
                                                    <table width="627" cellpadding="0" cellspacing="0" border="0"
                                                           class="table600">
                                                        <tr>
                                                            <td colspan="3" height="25"
                                                                style="font-size:0;line-height:0;" class="va2">
                                                                &nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="30" class="wz"></td>
                                                            <!--REGULAR TEXT SECTION-->
                                                            <td class="RegularText5TD"
                                                                style="color: #425065;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;">
                                                                
                                                                <b>Phone : {{ config('app.app_setting.phone') }} Email:
                                                                    <a href="mailto:{{ config('app.app_setting.ticket_email') }}"
                                                                       target="_blank"
                                                                       style="text-decoration: none;color: #ff675f;font-weight: bold;">{{ config('app.app_setting.ticket_email') }}</a><br>
                                                                    {{ config('app.app_setting.address') }}</b>
                                                            </td>
                                                            <td width="30" class="wz"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" height="30" class="va2"
                                                                style="font-size:0;line-height:0;">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->


    <!-- == FOOTER MODULE = MAILING OPTIONS == -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
           style="table-layout:fixed;margin:0 auto;">
        <tr>
            <td align="center">
                <table width="668" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#384855"
                       class="table600Min" style="table-layout:fixed;margin:0 auto;min-width:668px;">
                    <tr>
                        <td align="center" class="table600st" style="min-width:668px;">
                            <table width="629" align="center" cellpadding="0" cellspacing="0" bgcolor="#384855"
                                   border="0" class="table600Min"
                                   style="table-layout:fixed;margin:0 auto;min-width:629px;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width:629px;">
                                        <table width="610" align="center" cellpadding="0" cellspacing="0" border="0"
                                               class="table600">
                                            <tr>
                                                <td height="5"></td>
                                            </tr>
                                            <tr>
                                                <!--NOTES -->
                                                <td class="companyAddressTD"
                                                    style="color: #ff675f;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 13px;text-align: center;font-weight: bold;line-height: 190%;">
                                                    THANK YOU VERY MUCH FOR CHOOSING US
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="5" style="font-size:0;line-height:0;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="mailingOptionsTD"
                                                    style="color: #aab1bd;font-family: 'Zawgyi-One', 'roboto', 'arial';font-size: 12px;text-align: center;line-height: 170%;">
                                                    <i>For more information and FAQ, please vist our website at <a
                                                                href="{{ url('/') }}" target="_blank"
                                                                style="text-decoration: none;color: #ffffff;font-weight: bold;">{{ str_replace('http://', '', url('/')) }}
                                                                </a>.
                                                        Terms & Conditions apply and can be found on our
                                                        website.v2.2</i></td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END OF THE MODULE-->
</center>
</body>
</html>