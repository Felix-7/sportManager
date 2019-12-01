<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SportManager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @guest
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endguest
                </div>
            @endif



            <div class="content">

            @if (Route::has('login'))
                @auth
                <div class="title m-b-md">
                    {{$data}} {{ Auth::user()->name }}!
                </div>
                <div class="top-right links">
                    <a href="{{route('logout')}}">Logout</a>
                </div>
                <div class="links">
                    <a href="{{route('disciplines.index')}}">Messen</a>
                    <a href="{{route('stats.select')}}">Statistik</a>
                    @if(Auth::user()->id == 1 || Auth::user()->name == 'JAW')
                        <a href="{{route('admin')}}">Listen-Upload</a>
                        <a href="{{route('admin.accounts')}}">Lehreraccounts</a>
                    @endif
                </div>

                @else
                <div class="title m-b-md">
                    SportManager
                </div>
                <div class="links">

                    <a href="{{route('login')}}">Login</a>
                </div>
                @endauth
            @endif
            </div>



        </div>
    </body>
</html>
