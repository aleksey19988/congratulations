<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Congratulations</title>
</head>
<body class="">
<div class="footer container mx-auto p-4 bg-gray-600 mt-5 rounded-3xl px-16 flex justify-between">
    {{ \Illuminate\Support\Carbon::now()->format('Y') }}
    <div class="author flex">
        <span class="mr-3">Разработка: </span><a href="https://t.me/dev_kono" target="_blank"><img src="{{ asset('icons/telegram.svg') }}" alt="Telegram" width="25" height="25"></a>
    </div>
</div>
</body>
</html>
