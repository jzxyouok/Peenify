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
            font-size: 84px;
            font-family: "Raleway", Helvetica, Arial, sans-serif;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
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
            background-image: url("http://i.imgur.com/Hd1Cucl.png");
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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    {{--@if (Route::has('login'))--}}
        {{--<div class="top-right links">--}}
            {{--<a href="{{ url('/login') }}">Login</a>--}}
            {{--<a href="{{ url('/register') }}">Register</a>--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="content">
        <div class="title m-b-md">
            Welcome to Minimal, 查詢評分的平台。
        </div>

        <div class="flex-center customBtn">
            <a id="register-btn" class="btn btn-default btn-lg" href="{{ url('/register') }}">馬上註冊</a>
        </div>

        <div class="flex-center customBtn">
            <a id="login-btn" class="btn btn-default btn-lg" href="{{ url('/login') }}">登入</a>
        </div>

        <div class="flex-center customBtn">
            <a id="fb-btn" class="btn btn-default btn-lg facebook" href="{{ url('/auth/facebook') }}">透過 Facebook 註冊登入</a>
        </div>


    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</html>
