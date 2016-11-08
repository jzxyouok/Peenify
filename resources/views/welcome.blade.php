<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway';
            font-weight: 100;
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
            color: #FFFFFF;
        }

        .title {
            font-size: 70px;
            font-family: "Raleway", Helvetica, Arial, sans-serif;
        }

        .links > a {
            color: #FFFFFF;
            padding: 15px 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;

        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .customBtn {
            margin: 10px 10px;
        }

        body {
            background-color: #2A4F63;
            background-position: 50% 100%;
        }

        #register-btn {
            border-bottom: 4px solid #2ab27b;
        }

        #login-btn {
            border-bottom: 4px solid #398439;
        }

        #fb-btn {
            border-bottom: 4px solid #3A558E;
        }

        .nav-btn {
            color: #FFFFFF;
        }

        .description {
            padding-bottom: 50px;
        }

        .link__distance {
            margin: 2.5px 2.5px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content container">
        <div class="row title">
            <div class="text-center">
                Peenify
            </div>
        </div>
        <div class="row description">
            <div class="text-center">
                終極的評分平台。
            </div>
        </div>
        @if (Route::has('login') && Auth::guest())
            <div class="row">
                <div class="links col-md-4">
                    <a class="link__distance" href="{{ url('/login') }}">登入</a>
                </div>
                <div class="links col-md-4">
                    <a class="link__distance" href="{{ url('/auth/facebook') }}">Facebook 登入/註冊</a>
                </div>
                <div class="links col-md-4">
                    <a class="link__distance" href="{{ url('/register') }}">註冊</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="links">
                    <a href="{{ url('/home') }}">Home</a>
                </div>
            </div>
        @endif
    </div>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</html>
