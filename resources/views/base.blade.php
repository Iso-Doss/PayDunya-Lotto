{{-- resources/view/base.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @yield('title') {{ __(' | :app-name', ['app-name' => config('app.name')]) }}
    </title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }}">

    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = function (theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })

    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/blue_logoo.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    @yield('plugins-css')

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield('theme-css')

    <style>

        .modal-dialog table td {
            white-space: normal;
        }

        table td {
            white-space: normal !important;
        }

        .timeline-with-icons {
            border-left: 1px solid hsl(0, 0%, 90%);
            position: relative;
            list-style: none;
        }

        .timeline-with-icons .timeline-item {
            position: relative;
        }

        .timeline-with-icons .timeline-item:after {
            position: absolute;
            display: block;
            top: 0;
        }

        .timeline-with-icons .timeline-icon {
            position: absolute;
            left: -48px;
            background-color: hsl(217, 88.2%, 90%);
            color: hsl(217, 88.8%, 35.1%);
            border-radius: 50%;
            height: 31px;
            width: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

</head>

<body>

<!-- Header START -->
@yield('header')
<!-- Header END -->

<!-- **************** MAIN CONTENT START **************** -->
@yield('main')
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
Footer START -->
@yield('footer')
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
{{--@yield('bootstrap-js')--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('vendors')

<!-- Template Functions -->
<script src="{{ asset('assets/js/functions.js') }}"></script>
<script>
    (function ($) {
        $(document).ready(function () {

            hideOrShowNames($('select#profile-user-type').val());

            function hideOrShowNames(userType) {
                if ('PHYSICAL-PERSON' == userType) {
                    $('input#profile-name').parent().hide();
                    $('input#profile-ifu').parent().hide();
                    $('input#profile-first-name').parent().show();
                    $('input#profile-last-name').parent().show();
                } else if ('CORPORATION' == userType) {
                    $('input#profile-name').parent().show();
                    $('input#profile-ifu').parent().show();
                    $('input#profile-first-name').parent().hide();
                    $('input#profile-last-name').parent().hide();
                } else {
                    $('input#profile-first-name').parent().hide();
                    $('input#profile-last-name').parent().hide();
                    $('input#profile-name').parent().hide();
                    $('input#profile-ifu').parent().hide();
                }
            }

            $(document).on('change', 'select#profile-user-type', function (e) {
                hideOrShowNames($(this).val());
            });

            $(document).on('click', '.aec-hide-show-password', function (e) {
                let inputPasswordField = $(this).parents('.input-group').find('input');
                if ('password' === inputPasswordField.attr('type')) {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    inputPasswordField.attr('type', 'text');
                } else {
                    $(this).addClass('fa-eye');
                    $(this).removeClass('fa-eye-slash');
                    inputPasswordField.attr('type', 'password');
                }
            });

            $(document).on('click', '.aec-click-modal', function (e) {
                let aecModalTarget = $(this).attr('aec-modal-target');
                let aecModalTargetSelector = $('[data-bs-target="#' + aecModalTarget + '"]').children();
                if (aecModalTargetSelector) {
                    aecModalTargetSelector.click();
                }
            });

            $(document).on('click', '.aec-copy-address', function (e) {
                let aecCopyAddressTarget = $(this).attr('aec-copy-address-target');
                let aecCopyAddressTargetSelector = $('[data-aec-copy-address-target="' + aecCopyAddressTarget + '"]');
                copy(aecCopyAddressTargetSelector.attr('id'), "{{ __("Votre adresse a été copiée avec succès.") }}");
            });

            $(document).on('keyup keydown change', 'input[name="tracking_number"]', function () {
                $(this).val($(this).val().toUpperCase());
            });

            hideOrShowPasswordFields($('input[name="has_default_password"]').is(":checked"));

            function hideOrShowPasswordFields(has_default_password) {
                if (has_default_password) {
                    $('.create-user-password').parent().parent().hide();
                    $('.create-user-password').removeAttr('required')
                    $('.create-user-password-confirmation').parent().parent().hide();
                    $('.create-user-password-confirmation').removeAttr('required')
                } else {
                    $('.create-user-password').parent().parent().show();
                    $('.create-user-password').attr('required', true);
                    $('.create-user-password-confirmation').parent().parent().show();
                    $('.create-user-password-confirmation').attr('required', true);
                }
            }

            $(document).on('change', 'input[name="has_default_password"]', function (e) {
                hideOrShowPasswordFields($(this).is(":checked"));
            });

            // /**
            //  * Mettre des séparateurs de milliers pour les champs contenant des montants.
            //  */
            // $(document).on('change, keyup', '', function (e) {
            //
            //     let capital = $(this).val();
            //
            //     $(this).attr("type", "text");
            //
            //     while (capital.includes(".")) {
            //
            //         capital = capital.replace('.', '');
            //
            //     }
            //
            //     $(this).val(commify(capital.replace('.', '')));
            //
            // });
            //
            // /**
            //  * Mettre des séparateurs de montant pour le capital.
            //  *
            //  * @param capital The capital.
            //  * @returns {*}
            //  */
            // function commify(capital) {
            //
            //     const thousands = /\B(?=(\d{3})+(?!\d))/g;
            //
            //     return capital.replace(thousands, ".");
            //
            // }

            function copy(selector, message) {
                let text = document.getElementById(selector).innerText;
                let textareaSelector = document.createElement('textarea');
                textareaSelector.value = text;
                document.body.appendChild(textareaSelector);
                textareaSelector.select();
                document.execCommand("Copy");
                textareaSelector.className = 'textareaSelector';
                textareaSelector.style.display = 'none';
                alert(message);
            }

        });
    }(jQuery));
</script>
@yield('template-functions')
</body>
</html>

{{--https://freefrontend.com/bootstrap-timelines/--}}
{{--https://mdbootstrap.com/docs/standard/forms/datepicker/--}}
{{--https://bootsnipp.com/tags/timeline--}}
