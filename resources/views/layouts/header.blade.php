<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Congratulations</title>
</head>
<body class="">
<div class="header container mx-auto grid grid-cols-4 gap-x-5 p-4">
    <div class="logo-container flex justify-center items-center">
        <a href="/">
            <img class="logo-img" src="{{ asset('img/logo.svg') }}" alt="Логотип">
        </a>
    </div>
    <div class="actions-container grid grid-cols-2 gap-x-7 col-start-4">
        <div class="profile-container flex justify-center items-center">
            <span class="user-name">{{ Auth::user() ? Auth::user()->name : 'Неизвестный пользователь' }}</span>
        </div>
        <div class="buttons-container grid grid-rows-4 grid-cols-2 gap-2">
            <a href="{{ route('profile.edit') }}" class="profile-button header-action-button row-span-2 col-span-2 flex justify-center items-center">
                <img src="{{ asset('icons/profile.svg') }}" alt="Профиль">
            </a>
            <form action="{{ route('logout') }}" method="post" class="row-span-2 col-span-2">
                @csrf
                @method('POST')
                <button type="submit" class="logout-button header-action-button flex justify-center items-center w-full">
                    <img src="{{ asset('icons/logout.svg') }}" alt="Выйти">
                </button>
            </form>

        </div>
    </div>
</div>
@yield('content')
@include('layouts.footer')
</body>
</html>
