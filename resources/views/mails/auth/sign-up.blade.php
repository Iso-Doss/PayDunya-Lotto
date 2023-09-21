{{-- ressources/views/mails/auth/sign-up.blade.php --}}

{{-- Create account (Sign up) --}}

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

                            {{ __('Nous vous remercions d\'avoir crée votre compte sur') }}

                            <b>{{ config('app.name') }}</b>

                            {{ __('.') }}

                        </span>

                    </p>

                    <p style="font-size: 14px; line-height: 160%; text-align: left;">

                        <span style="font-size: 18px; line-height: 29px;">

                            @if (!empty($user->profile) && $user->profile == "CUSTOMER")

                                {{ __('Afin de valider votre compte, nous vous prions de cliquer sur le bouton / lien ci-dessous.') }}

                            @else

                                {{ __('La validation de votre compte nécessite la vérification de votre identité. Veuillez patienter le temps qu\'un de nos agents vérifie vos informations afin de valider votre comte. Si cette requête n\'est pas traitée dans les prochaines 24 heures, veuillez nous contacter.') }}

                            @endif

                        </span>

                    </p>

                </div>

            </td>

        </tr>

        </tbody>

    </table>

    @if (!empty($user->profile) && $user->profile == "CUSTOMER")

        <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
               width="100%"
               border="0">

            <tbody>

            <tr>

                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Oakes Grotesk',sans-serif;"
                    align="left">

                    <div align="center">

                        <a href="{{ route('customer.auth.validate-account', ['email' => $user->email, 'token' => $data['token']]) }}"
                           target="_blank"
                           style="box-sizing: border-box;display: inline-block;font-family:'Oakes Grotesk',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #df6439; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; border-radius: 25px;">

                            <span style="display:block;padding:14px 44px 13px;line-height:120%;">

                                {{ __('Valider mon compte') }}

                            </span>

                        </a>

                    </div>

                </td>

            </tr>

            </tbody>

        </table>

        @if (isset($user->has_default_password) && $user->has_default_password)

            <table style="font-family:'Oakes Grotesk',sans-serif;" role="presentation"
                   cellpadding="0" cellspacing="0" width="100%" border="0">

                <tbody>

                <tr>

                    <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 55px 10px;font-family:'Oakes Grotesk',sans-serif;"
                        align="left">

                        <div style="line-height: 160%; text-align: center; word-wrap: break-word;">

                            <p style="font-size: 14px; line-height: 160%; text-align: left;">

                                <span style="font-size: 18px; line-height: 29px;">

                                    {{"Lors de votre inscription vous n'avez pas spécifier / définir de mot de passe pour votre compte, vous recevrez un deuxième mail avec un mot de passe par défaut qui a été généré pour vous."}}

                                </span>

                            </p>

                        </div>

                    </td>

                </tr>

                </tbody>

            </table>

        @endif

    @endif

@endsection
