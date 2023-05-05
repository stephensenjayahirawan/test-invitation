<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('subject')</title>
    {{-- <link type="text/css" rel="stylesheet" href="{{ asset('email/css/email.css') }}"> --}}
    <style>
         /* Base ------------------------------ */
        *:not(br):not(tr):not(html) {
            font-family: 'Rockford Sans Light', 'Helvetica Neue', Helvetica, sans-serif;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            line-height: 1.4;
            background-color: #F5F7F9;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #414EF9;
        }
        .subject-title {
            color: #214390;
            text-align: center;
        }
        .text-highlighted {
            color: #204490;
            font-weight: bold;
        }

        /* Layout ------------------------------ */
        .img-footer {
            display:inline-block; 
            text-align: center; 
            margin-left: auto; 
            margin-right: auto;
        }
        .img-footer-wrapper {
            text-align: center;
        }

        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #F5F7F9;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Masthead ----------------------- */
        .email-masthead {
            text-align: center;
        }

        .email-masthead_logo {
            max-width: 400px;
            border: 0;
        }

        .email-masthead_name {
            font-size: 16px;
            font-weight: bold;
            color: #839197;
            text-decoration: none;
            text-shadow: 0 1px 0 white;
            width:100px;
        }

        /* Body ------------------------------ */
        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            border-top: 1px solid #E7EAEC;
            border-bottom: 1px solid #E7EAEC;
            background-color: #FFFFFF;
        }

        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 0;
        }

        .email-footer {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }
        .email-footer-content {
            background-color: #b6c6dd;
        }
        .email-footer-text {
            font-weight: bold;
            color: black;
            text-align: center;
        }
        .img-icon-social {
            height:35px; 
            width:35px;
        }

        .email-footer p {
            color: #839197;
        }
        .social-link { 
            text-decoration:none;
        }

        .body-action {
            width: 100%;
            margin: 30px auto;
            padding: 0;
            text-align: center;
        }

        .body-sub {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #E7EAEC;
            
        }

        .content-cell {
            padding: 35px;
        }

        .align-right {
            text-align: right;
        }

        /* Type ------------------------------ */
        h1 {
            margin-top: 0;
            color: #292E31;
            font-size: 19px;
            font-weight: bold;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            color: #292E31;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #292E31;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        p {
            margin-top: 0;
            color: black;
            font-size: 16px;
            line-height: 1.5em;
            text-align: left;
        }

        p.sub {
            font-size: 12px;
            text-align: center;
        }

        p.center {
            text-align: center;
        }

        /* Buttons ------------------------------ */
        .button {
            display: inline-block;
            width: 200px;
            background-color: #414EF9;
            border-radius: 3px;
            color: #ffffff;
            font-size: 15px;
            line-height: 45px;
            text-align: center;
            text-decoration: none;
            -webkit-text-size-adjust: none;
            mso-hide: all;
        }

        .button--green {
            background-color: #28DB67;
        }

        .button--red {
            background-color: #FF3665;
        }

        .button--blue {
            background-color: #214390;
        }

        /*Media Queries ------------------------------ */
        @media only screen and (max-width: 600px) {

            .email-body_inner,
            .email-footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <table class="email-wrapper" cellpadding="0" cellspacing="0" >
        <tr>
            <td align="center">
                <table class="email-content" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td class="email-masthead">
                            <a target="_blank" href="https://ngelesin.com" class="email-masthead_name">
                                <img style="max-width: 570px; height: auto" src="{{asset('email/img/header.jpeg')}}">
                            </a>
                        </td>
                    </tr>
                    <!-- Email Body -->
                    <tr>
                        <td class="email-body">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  --}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>