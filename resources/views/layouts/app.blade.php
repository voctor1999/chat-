<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css') }}">
    <title>@yield('title','bbschat实战')--Laravel实战</title>
</head>

<body>
    @include('layouts._header')
    <div id="base" class="container">

        @include('shared._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
    <script src="{{mix('js/app.js') }}"></script>
</body>

</html>