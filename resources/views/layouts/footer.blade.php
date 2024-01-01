<div class="footer container  p-4 bg-slate-700 mt-5 rounded-3xl px-16 flex justify-between fixed bottom-5 w-11/12">
    {{ \Illuminate\Support\Carbon::now()->format('Y') }}
    <div class="author flex">
        <span class="mr-3">Разработка: </span><a href="https://t.me/dev_kono" target="_blank"><img src="{{ asset('icons/telegram.svg') }}" alt="Telegram" width="25" height="25"></a>
    </div>
</div>
