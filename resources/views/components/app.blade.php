<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Basic crud test</title>
</head>
<body class="flex flex-col h-full bg-gray-100">
    <x-navigation>
    </x-navigation>
    <div class="h-full p-6 self-center">
        {{ $slot }}
    </div>
</body>
</html>