<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<div class="header container mx-auto grid grid-cols-4 gap-x-5 p-4">
    <div class="logo-container flex justify-center items-center">
        <a href="#">
            <img class="logo-img" src="{{ asset('img/logo.svg') }}" alt="Логотип">
        </a>
    </div>
    <div class="datetime-container flex justify-center items-center col-span-2">
        <div class="date-time">
            Сегодня {{ \Carbon\Carbon::now()->locale('ru')->translatedFormat('d F Y, l') }}
        </div>
    </div>
    <div class="actions-container grid grid-cols-2 gap-x-7">
        <div class="profile-container flex justify-center items-center">
            <a href="#" class="user-name">Петров А.</a>
        </div>
        <div class="buttons-container grid grid-rows-4 grid-cols-3 gap-2">
            <div class="theme-toggle-container row-span-4 flex justify-between items-center flex-col">
                <div class="toggle-circle"></div>
                <img src="{{ asset('icons/dot.svg') }}" alt="">
                <img src="{{ asset('icons/dot.svg') }}" alt="">
                <img src="{{ asset('icons/sun.svg') }}" alt="">
            </div>
            <a class="profile-button row-span-2 col-span-2 flex justify-center items-center" href="#">
                <img src="{{ asset('icons/profile.svg') }}" alt="Профиль">
            </a>
            <a class="logout-button row-span-2 col-span-2 flex justify-center items-center" href="#">
                <img src="{{ asset('icons/logout.svg') }}" alt="Выйти">
            </a>
        </div>
    </div>
</div>
@yield('content')
</body>
</html>
