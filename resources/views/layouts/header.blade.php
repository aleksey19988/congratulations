<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Congratulations</title>
</head>
<body class="flex flex-col items-center bg-slate-950 text-white py-5 px-10 mb-20">
<div class="
    container
    mx-auto
    grid
    grid-cols-1
    gap-2
    md:grid-cols-3
    lg:grid-cols-4
    xl:grid-cols-6
    gap-x-5
    p-4
    bg-slate-700
    rounded-3xl
">
    <div class="flex justify-center items-center bg-slate-950 rounded-3xl p-5 col-end-2">
        <a href="/">
            <img class="logo-img xl:h-10" src="{{ asset('img/logo.svg') }}" alt="Логотип">
        </a>
    </div>
    <div class="grid grid-cols-2 gap-x-7 md:col-start-3 lg:col-start-4 xl:col-start-6 bg-slate-950 rounded-3xl p-5 xl:py-2">
        <div class="flex justify-center items-center">
            <a href="{{ route('profile.edit') }}" class="profile-button header-action-button flex justify-center items-center xl:h-8 w-full">
                <img class="h-full xl:h-5" src="{{ asset('icons/profile.svg') }}" alt="Профиль">
            </a>
        </div>
        <div class="flex justify-center items-center">
            <form action="{{ route('logout') }}" method="post" class="xl:h-8 w-full">
                @csrf
                @method('POST')
                <button type="submit" class="logout-button header-action-button flex justify-center items-center w-full h-full">
                    <img class="h-full xl:h-5" src="{{ asset('icons/logout.svg') }}" alt="Выйти">
                </button>
            </form>
        </div>
    </div>
</div>
@yield('content')
@include('layouts.footer')
</body>
</html>
