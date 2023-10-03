{{-- ressources/views/mails/profile/update-email.blade.php --}}

{{-- Update email --}}

@extends('mails.base')

@section('content')

    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
           cellpadding="0" cellspacing="0" width="100%" border="0">

        <tbody>

        <tr>

            <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 55px 10px;font-family:'Oakes Grotesk',sans-serif;"
                align="left">

                <div style="line-height: 160%; text-align: center; word-wrap: break-word;">

                    <p style="font-size: 14px; line-height: 160%; text-align: left;">

                        <span style="font-size: 18px; line-height: 28.8px;">

                            {{ $message }}

                        </span>

                    </p>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

    <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
           width="100%"
           border="0">

        <tbody>

        <tr>

            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Oakes Grotesk',sans-serif;"
                align="left">

                <div align="center">

                    <a href="{{ route(strtolower($user->profile) . '.profile.validate-update-email', ['email' => $data['old_email'], 'new_email' => $data['email'], 'token' => $data['token']]) }}"
                       target="_blank"
                       style="box-sizing: border-box;display: inline-block;font-family:'Oakes Grotesk',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #df6439; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; border-radius: 25px;">

                        <span style="display:block;padding:14px 44px 13px;line-height:120%;">

                            {{ __('Mettre a jour mon adresse e-mail') }}

                        </span>

                    </a>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

@endsection
