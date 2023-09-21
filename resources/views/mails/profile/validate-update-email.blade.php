{{-- ressources/views/mails/profile/validate-update-email.blade.php --}}

{{-- Validate update email --}}

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

                            {{ __('La mise a jour de votre adresse mail a bien été prise en compte.') }}

                        </span>

                    </p>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

@endsection
