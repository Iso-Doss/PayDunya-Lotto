{{-- ressources/views/mails/auth/validate-account.blade.php --}}

{{-- Validate account --}}

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

                            {{ "Nous vous remercions d'avoir crée votre compte sur " }}

                            <b>{{ config('app.name') }}</b>

                        </span>

                    </p>

                    <p style="font-size: 14px; line-height: 160%; text-align: left;">

                        <span style="font-size: 18px; line-height: 29px;">

                            {{ __('La validation de votre compte a été effectuée avec succès. Vous pouvez vous connecter.') }}

                        </span>

                    </p>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

@endsection
