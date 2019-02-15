<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>
<body>
<div class="container">
    @yield('content');
</div>
<script type="text/javascript" src="{{URL::asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/invoice_add/invoice-add.js')}}"></script>
    @yield('scripts');
</body>
</html>
