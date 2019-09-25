<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <form method="post">
        @csrf
        <input  type="text" name="hash" id="hash">
        <button type="submit" id="button">Gerar url</button>
    </form>
    @if(isset($url))
        {{dd($url)}}
    @endif
</body>
</html>
