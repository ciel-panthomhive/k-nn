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
    <style>
        header[role="banner"] #logo-main {
            display: block;
            margin: 30px;
        }

        #navbar-primary.navbar-default {
            background: transparent;
            border: none;
        }

        #navbar-primary.navbar-default .navbar-nav {
            width: 100%;
            text-align: center;
        }

        #navbar-primary.navbar-default .navbar-nav>li {
            display: inline-block;
            float: none;
        }

        #navbar-primary.navbar-default .navbar-nav>li>a {
            padding-left: 30px;
            padding-right: 30px;
        }

        .social-media-nav {
            position: absolute;
            right: 0;
            top: 2rem;
        }

        /* .carousel-control-next,
        .carousel-control-prev {
            width: 7%;
        } */

        .text-red {
            color: #ff0000;
        }

        .text-gold {
            color: #ffff00;
        }

        .bg-red {
            background-color: #ff0000;
        }

        .bg-gold {
            background-color: #ffff00;
        }


        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu {
                display: none;
            }

            /* .navbar .nav-item:hover .nav-link{ color: #fff;  } */
            /* .nav-link {
                font-size: 20px
            } */

            .navbar .nav-item:hover .dropdown-menu {
                display: block;
            }

            .navbar .nav-item .dropdown-menu {
                margin-top: 0;
            }
        }

        .card,
        .card-img,
        .card-img-top {
            border-radius: 0;
        }

        .polygon-test {
            clip-path: polygon(0 13%, 100% 0, 100% 100%, 0 87%);
        }
    </style>
</head>

<body>
    @include('layouts.app')

    @yield('content')

    @include('layouts.component.footer')
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>

</html>
