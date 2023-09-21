{{-- ressources/views/mails/auth/sign-up-default-password.blade.php --}}

{{-- Create account default password --}}

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

                    <span style="font-size: 18px; line-height: 29px;">

                        {{ "Un compte vous a été crée sur " }}

                        <b>{{ config('app.name') }}</b>

                    </span>

                    </p>

                    <p style="font-size: 14px; line-height: 160%; text-align: left;">

                    <span style="font-size: 18px; line-height: 29px;">

                        {{ __('Ci-dessous votre mot de passe par défaut. Vous pourrez le changer à tout moment.') }}

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

                    <div style="border: solid; line-height:50px; width: 50%;">
                        <span style="font-size: 25px; font-weight: bold;">
                            {{ $data['default_password'] }}
                        </span>
                    </div>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

@endsection
