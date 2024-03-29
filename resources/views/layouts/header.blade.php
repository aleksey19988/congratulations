<!doctype html>
<html id="html" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Congratulations</title>
</head>
<body class="flex flex-col items-center bg-slate-300 dark:bg-slate-950 dark:text-white py-5 px-10 mb-20">
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
    bg-white
    dark:bg-slate-700
    rounded-3xl
">
    <div class="flex justify-center items-center bg-slate-300 dark:bg-slate-950 rounded-3xl p-5 col-end-2">
        <a href="/">
            <img class="h-10" src="{{ asset('img/logo.svg') }}" alt="Логотип">
        </a>
    </div>
    <div class="grid grid-cols-4 gap-2 md:col-start-3 lg:col-start-4 xl:col-start-6 bg-slate-300 dark:bg-slate-950 rounded-3xl p-5 xl:py-2">
        <div class="flex justify-center items-center col-span-4">
            <a href="{{ route('profile.edit') }}" data-tooltip-target="tooltip-profile-button" data-tooltip-placement="bottom" class="flex justify-center items-center p-2 xl:h-8 w-full bg-slate-700 rounded-3xl hover:scale-105 transition-all">
                <button type="button">
                    <img class="h-5" src="{{ asset('icons/profile.svg') }}" alt="Профиль">
                </button>
            </a>
            <div id="tooltip-profile-button" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Профиль
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <div class="flex justify-center items-center col-span-2">
            <form action="{{ route('logout') }}" method="post" class="xl:h-8 w-full">
                @csrf
                @method('POST')
                <button type="submit" data-tooltip-target="tooltip-logout-button" data-tooltip-placement="bottom" class="flex justify-center items-center p-2 w-full h-full bg-red-500 rounded-3xl hover:scale-105 transition-all">
                    <img class="h-5" src="{{ asset('icons/logout.svg') }}" alt="Выйти">
                </button>
                <div id="tooltip-logout-button" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Выйти
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </form>
        </div>
        <button data-tooltip-target="tooltip-theme-toggle-button" data-tooltip-placement="bottom" class="flex justify-center items-center col-span-2 bg-white dark:bg-slate-700 rounded-3xl hover:scale-105 transition-all js-theme-toggle-button" id="js-theme-toggle-button">
            <img class="dark:hidden h-5" src="{{ asset('icons/moon.svg') }}" alt="Тёмный режим">
            <img class="hidden dark:block h-5" src="{{ asset('icons/sun.svg') }}" alt="Светлый режим">
        </button>
        <div id="tooltip-theme-toggle-button" role="tooltip" class="absolute z-10 invisible hidden xl:inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Переключить тему
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</div>
@yield('content')
@include('layouts.footer')
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
<script
    type="module"
    src="/node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>
@vite('resources/js/app.js')
</body>
</html>
