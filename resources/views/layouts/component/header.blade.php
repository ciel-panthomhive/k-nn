<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <title>BIRAWA CELL</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <style>
        @use postcss-preset-env {
            stage: 0;
        }

        /* config.css */

        :root {
            --baseColor: #606468;
        }

        /* helpers/align.css */

        /* .align {
            display: grid;
            place-items: center;
        } */

        .grid {
            inline-size: 90%;
            margin-inline: auto;
            max-inline-size: 20rem;
        }

        /* helpers/hidden.css */

        .hidden {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        /* helpers/icon.css */

        :root {
            --iconFill: var(--baseColor);
        }

        .icons {
            display: none;
        }

        .icon {
            block-size: 1rem;
            display: inline-block;
            fill: var(--iconFill);
            inline-size: 1rem;
            vertical-align: middle;
        }

        /* layout/base.css */

        :root {
            --htmlFontSize: 100%;

            /* --bodyBackgroundColor: #2c3338; */
            background-image: url({{ asset('./assets/images/background.jpg') }});
            /* height: 100vh; */
            no-repeat center center fixed;
            background-size: cover;
            /* --bodyBackgroundColor: #ffff66; */
            --bodyColor: var(--baseColor);
            --bodyFontFamily: "Open Sans";
            --bodyFontFamilyFallback: sans-serif;
            --bodyFontSize: 0.875rem;
            --bodyFontWeight: 400;
            --bodyLineHeight: 1.5;
        }

        * {
            box-sizing: inherit;
        }

        html {
            box-sizing: border-box;
            font-size: var(--htmlFontSize);
        }

        body {
            background-color: var(--bodyBackgroundColor);
            color: var(--bodyColor);
            font-family: var(--bodyFontFamily), var(--bodyFontFamilyFallback);
            font-size: var(--bodyFontSize);
            font-weight: var(--bodyFontWeight);
            line-height: var(--bodyLineHeight);
            margin: 0;
            min-block-size: 100vh;
        }

        /* modules/anchor.css */

        :root {
            --anchorColor: #eee;
        }

        a {
            color: var(--anchorColor);
            outline: 0;
            text-decoration: none;
        }

        .btn-link {
            color: var(--anchorColor);
            outline: 0;
            text-decoration: none;
        }

        .btn-link:hover {
            background-color: var(--baseColor);
            color: var(--anchorColor);
            outline: 0;
            font-weight: bold;
            text-decoration: none;
        }

        a:focus,
        a:hover {
            text-decoration: underline;
        }

        /* modules/form.css */

        :root {
            --formGap: 0.875rem;
        }

        input {
            background-image: none;
            border: 0;
            color: inherit;
            font: inherit;
            margin: 0;
            outline: 0;
            padding: 0;
            transition: background-color 0.3s;
        }

        input[type="submit"] {
            cursor: pointer;
            /* background-color: #ff0000; */
        }

        .form {
            display: grid;
            gap: var(--formGap);
        }

        .form input[type="password"],
        .form input[type="email"],
        .form input[type="submit"] {
            inline-size: 100%;
        }

        .form__field {
            display: flex;
        }

        .form__input {
            flex: 1;
        }

        /* modules/login.css */

        :root {
            --loginBorderRadus: 0.25rem;
            --loginColor: #eee;

            --loginInputBackgroundColor: #3b4148;
            /* --loginInputBackgroundColor: #ffff99; */
            --loginInputHoverBackgroundColor: #434a52;
            /* --loginInputHoverBackgroundColor: #ffffcc; */

            --loginLabelBackgroundColor: #363b41;
            /* --loginLabelBackgroundColor: #ffff00; */

            /* --loginSubmitBackgroundColor: #ea4c88; */
            --loginSubmitBackgroundColor: #cc0000;
            --loginSubmitColor: #eee;
            /* --loginSubmitHoverBackgroundColor: #d44179; */
            --loginSubmitHoverBackgroundColor: #ff0000;
        }

        .login {
            color: var(--loginColor);
            /* place-items: center; */
            background: rgba(4, 29, 23, 0.5);
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 50px;
            padding-bottom: 50px;
            width: 100%;
            box-shadow: 0px 0px 25px 10px black;
            border-radius: 15px;
        }

        .login label,
        .login input[type="email"],
        .login input[type="password"],
        .login input[type="submit"] {
            border-radius: var(--loginBorderRadus);
            padding: 1rem;
        }

        .login label {
            background-color: var(--loginLabelBackgroundColor);
            border-bottom-right-radius: 0;
            border-top-right-radius: 0;
            padding-inline: 1.25rem;
        }

        .login input[type="password"],
        .login input[type="email"] {
            background-color: var(--loginInputBackgroundColor);
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
        }

        .login input[type="password"]:focus,
        .login input[type="password"]:hover,
        .login input[type="email"]:focus,
        .login input[type="email"]:hover {
            background-color: var(--loginInputHoverBackgroundColor);
        }

        .login input[type="submit"] {
            background-color: var(--loginSubmitBackgroundColor);
            color: var(--loginSubmitColor);
            font-weight: 700;
            text-transform: uppercase;
        }

        .login input[type="submit"]:focus,
        .login input[type="submit"]:hover {
            background-color: var(--loginSubmitHoverBackgroundColor);
        }

        /* modules/text.css */

        p {
            margin-block: 1.5rem;
        }

        .text--center {
            text-align: center;
        }

        img.tengah {
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 50%;
        }
    </style>
</head>


<body>
    @yield('content')

</body>
