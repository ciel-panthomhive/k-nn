<!DOCTYPE html>
<html>

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            margin: 0;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 15%;
            background-color: #ff0000;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        li {
            border-bottom: 1px solid #ff6347;
        }

        li a {
            display: block;
            color: #ffffff;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* li a.active {
            background-color: #ffff00;
            color: #ff0000;
            font-weight: bold;
        } */

        /* li a:hover {
            background-color: #ffff00;
            font-weight: bold;
            color: #ff0000;
        } */

        li a:hover {
            background-color: #ff4040;
            color: white;
        }

        img.tengah {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .slide {
            position: fixed;
            width: 5px;
            height: 42px;
            background: #ffff00;
            font-weight: bold;
            z-index: -1;
            transition: 0s;
            opacity: 0;
        }

        ul li:nth-child(2).active~.slide {
            top: 150px;
            opacity: 1;
        }

        ul li:nth-child(3).active~.slide {
            top: 190px;
            opacity: 1;
        }

        ul li:nth-child(4).active~.slide {
            top: 231px;
            opacity: 1;
        }

        ul li:nth-child(5).active~.slide {
            top: 270px;
            opacity: 1;
        }

        .garis {
            border: 1px solid #c0c0c0;
        }
    </style>

</head>

<body>

    <ul>
        <a href="{{ url('/') }}">
            <img class="tengah" src="{{ asset('assets/images/logo.png') }}" style="width: 150px; padding: 20px"
                alt="Logo Thing main logo">
        </a>

        <li class="{{ request()->is('home', 'testadd') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
                <i class='bx bx-grid-alt nav_icon'>&nbsp;&nbsp;Data Training</i>
            </a>
        </li>
        <li class="{{ request()->is('uji', 'ujiadd') ? 'active' : '' }}"><a href="{{ route('uji.read') }}">
                <i class='bx bx-bar-chart-alt-2 nav_icon'>&nbsp;&nbsp;Data Uji</i>
            </a>
        </li>
        <li class="{{ request()->is('profil/{id)') ? 'active' : '' }}"><a
                href="{{ route('profil', ['id' => Auth::user()->id]) }}">
                <i class='bx bx-user nav_icon'>&nbsp;&nbsp;Profil</i>
            </a>
        </li>

        <li>
            <form action="{{ route('profil', ['id' => Auth::user()->id]) }}" method="POST" class="d-none">
                @csrf
            </form>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();                                                                                                                                                                                                                                                                                                                                                                                                                                                                               document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon'>&nbsp;&nbsp;{{ __('Logout') }}</i>

            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('li').on('click', function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            })
        })
    </script> --}}
    @include('layouts.alert')
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
