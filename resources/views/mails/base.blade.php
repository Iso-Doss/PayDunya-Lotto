{{-- resources/view/mails/base.blade.php --}}

    <!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="x-apple-disable-message-reformatting">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>

        {{ __(':title | :app-name ', ['title' => (isset($data['$title']) && !empty($data['$title'])) ? $data['$title'] : __('Mail Notification'), 'app-name' => config('app.name')]) }}

    </title>

    <style>

        @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }

            .u-row .u-col {
                vertical-align: top;
            }

            .u-row .u-col-100 {
                width: 600px !important;
            }
        }

        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .u-row {
                width: calc(100% - 40px) !important;
            }

            .u-col {
                width: 100% !important;
            }

            .u-col >
            div {
                margin: 0 auto;
            }
        }

        body {
            margin: 0;
            padding: 0;
        }

        table,
        tr,
        td {
            vertical-align: top;
            border-collapse: collapse;
        }

        p {
            margin: 0;
        }

        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }

        table,
        td {
            color: #000000;
        }

        a {
            color: #0972b5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body class="clean-body u_body"
      style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9f9;color: #000000">

<table
    style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%"
    cellpadding="0" cellspacing="0">

    <tbody>

    <tr style="vertical-align: top">

        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

            <div class="u-row-container" style="padding: 0;">

                <div class="u-row"
                     style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

                    <div style="border-collapse: collapse;display: table;width: 100%;">

                        <div class="u-col u-col-100"
                             style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">

                            <div style="width: 100% !important;">

                                <div
                                    style="padding: 0;border-top: 0 solid transparent;border-left: 0 solid transparent;border-right: 0 solid transparent;border-bottom: 0 solid transparent;">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="u-row-container" style="padding: 0;">

                <div class="u-row"
                     style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #0972b5;">

                    <div style="border-collapse: collapse;display: table;width: 100%;">

                        <div class="u-col u-col-100"
                             style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">

                            <div style="width: 100% !important;">

                                <div
                                    style="padding: 0;border-top: 0 solid transparent;border-left: 0 solid transparent;border-right: 0 solid transparent;border-bottom: 0 solid transparent;">

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0"
                                           cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td
                                                style="overflow-wrap:break-word;word-break:break-word;padding:40px 10px 10px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                                    <tr>

                                                        <td style="padding-right: 0;padding-left: 0;"
                                                            align="center">

                                                        </td>

                                                    </tr>

                                                </table>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0"
                                           cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td
                                                style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 31px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <div
                                                    style="color: #e5eaf5; line-height: 140%; text-align: center; word-wrap: break-word;">

                                                    <p style="font-size: 14px; line-height: 140%;">

                                                        <span style="font-size: 28px; line-height: 39.2px;">

                                                            <strong>

                                                                <span style="line-height: 39.2px; font-size: 28px;">

                                                                    {{ mb_strtoupper( $data['title'] ) }}

                                                                </span>

                                                            </strong>

                                                        </span>

                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="u-row-container" style="padding: 0;">

                <div class="u-row"
                     style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">

                    <div style="border-collapse: collapse;display: table;width: 100%;">

                        <div class="u-col u-col-100"
                             style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">

                            <div style="width: 100% !important;">

                                <div
                                    style="padding: 0;border-top: 0 solid transparent;border-left: 0 solid transparent;border-right: 0 solid transparent;border-bottom: 0 solid transparent;">

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0" cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 55px 10px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <div
                                                    style="line-height: 160%; text-align: center; word-wrap: break-word;">

                                                    <p style="font-size: 14px; line-height: 160%; text-align: left;">

                                                        <span style="font-size: 18px; line-height: 28.8px;">

                                                            @php

                                                                $show_name = __('Cher Utilisateur');

                                                                if (!empty($user->profile) && $user->profile == "CUSTOMER") {

                                                                    $show_name = __('Cher Utilisateur');

                                                                }else if (!empty($user->profile) && $user->profile == "AGENT") {

																	$show_name = __('Cher Agent');

                                                                }else if (!empty($user->profile) && $user->profile == "ADMINISTRATOR") {

																	$show_name = __('Cher Administrateur');

                                                                } else {

                                                                    $show_name = __('Cher Utilisateur');

                                                                }

                                                            @endphp

                                                            {{ __('Bonjour  :show-name,', ['show-name' => $show_name]) }}

                                                        </span>

                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                    @yield('content')

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0" cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 55px 20px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <div
                                                    style="line-height: 160%; text-align: center; word-wrap: break-word;">

                                                    <p style="line-height: 160%; font-size: 14px; text-align: left;">

                                                        <span style="font-size: 18px; line-height: 28.8px;">

                                                            {{ __('Auriez-vous des questions ?') }}

                                                            <br/>

                                                            {{ __('N\'hésitez pas à nous contacter directement via :') }}

                                                        </span>

                                                    </p>

                                                    <ul>

                                                        <li style="line-height: 22.4px; font-size: 14px; text-align: left;">

                                                            <span style="font-size: 18px; line-height: 28.8px;">

                                                                <a rel="noopener" href="#"
                                                                   target="_blank">

                                                                    {{ __('WhatsApp') }}

                                                                </a>

                                                            </span>

                                                        </li>

                                                        <li style="line-height: 22.4px; font-size: 14px; text-align: left;">

                                                            <span style="font-size: 18px; line-height: 28.8px;">

                                                                <a rel="noopener" href="#" target="_blank">

                                                                    <b>{{ config('app.name') }}</b>

                                                                </a>

                                                            </span>

                                                        </li>

                                                    </ul>

                                                    <p style="line-height: 160%; font-size: 14px;">

                                                        <span style="font-size: 18px; line-height: 28.8px;">

                                                            {{ __('A très bientôt,') }}

                                                        </span>

                                                    </p>

                                                    <p style="line-height: 160%; font-size: 14px;">

                                                        <strong>

                                                            <span style="font-size: 18px; line-height: 28.8px;">

                                                                {{ __('La Team :app-name', ['app-name' => config('app.name')]) }}

                                                            </span>

                                                        </strong>

                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="u-row-container" style="padding: 0;">

                <div class="u-row"
                     style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F0F9FA;">

                    <div style="border-collapse: collapse;display: table;width: 100%;">

                        <div class="u-col u-col-100"
                             style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">

                            <div style="width: 100% !important;">

                                <div
                                    style="padding: 0;border-top: 0 solid transparent;border-left: 0 solid transparent;border-right: 0 solid transparent;border-bottom: 0 solid transparent;">

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0" cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:41px 55px 18px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <div
                                                    style="color: #0972b5; line-height: 160%; text-align: center; word-wrap: break-word;">

                                                    <p style="font-size: 14px; line-height: 160%;">

                                                        <b>
                                                            {{ config('app.name') }}
                                                        </b>

                                                        {{ __('(Mettre ici les informations relatives a l\'application / l\'entreprise).') }}

                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="u-row-container" style="padding: 0;">

                <div class="u-row"
                     style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #0972b5;">

                    <div style="border-collapse: collapse;display: table;width: 100%;">

                        <div class="u-col u-col-100"
                             style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">

                            <div style="width: 100% !important;">

                                <div
                                    style="padding: 0;border-top: 0 solid transparent;border-left: 0 solid transparent;border-right: 0 solid transparent;border-bottom: 0 solid transparent;">

                                    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                                           cellpadding="0" cellspacing="0" width="100%" border="0">

                                        <tbody>

                                        <tr>

                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Oakes Grotesk',sans-serif;"
                                                align="left">

                                                <div
                                                    style="color: #fafafa; line-height: 180%; text-align: center; word-wrap: break-word;">

                                                    <p style="font-size: 14px; line-height: 180%;">

                                                        <span style="font-size: 16px; line-height: 28.8px;">

                                                            {{ __('Copyrights © :year', ['year' => date('Y')]) }}

                                                            <b>
                                                                {{ config('app.name') }}
                                                            </b>

                                                            {{ __(' - Tous droits réservés') }}

                                                        </span>

                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </td>

    </tr>

    </tbody>

</table>

</body>

</html>
