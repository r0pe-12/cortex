<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blade</title>
</head>
<body>

<h1>{{$title}}</h1>
<hr>
<h3>Name: {{ $name }}</h3>
<h4>Phone: <a href="tel:{{$phone}}"></a>{{$phone}}</h4>
<h4>Date: {{ now('Europe/Belgrade')->format('Y-m-d H:i:s') }}</h4>
<hr>
<p>{!! $content !!}</p>

</body>
</html>

