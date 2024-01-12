<footer class="
    bottom-0
    left-0
    border-t
    border-gray-200
    shadow
    dark:border-gray-600
    py-4
    px-20
    bg-white
    dark:bg-slate-700
    fixed
    w-full
    z-50
    dark:shadow-none">
    <div class="container mx-auto flex justify-between">
        {{ \Illuminate\Support\Carbon::now()->format('Y') }}
        <div class="author flex">
            <span class="mr-3">Разработка: </span><a href="https://t.me/dev_kono" target="_blank"><img src="{{ asset('icons/telegram.svg') }}" alt="Telegram" width="25" height="25"></a>
        </div>
    </div>
</footer>
