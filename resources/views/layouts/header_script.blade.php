<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{asset('img/icon.png')}}" type="image/x-icon">
    <link href="{{ asset('css/min.css') }}" rel="stylesheet">
    @yield('ext_header_script')
</head>