@props(['disabled' => false])

<div
    class="relative w-96 flex"
    data-te-format="dd.mm.yyyy"
    id="date-input"
    data-te-datepicker-init
    data-te-input-wrapper-init>
    <input
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' => '
                p-3
                peer
                block
                min-h-[auto]
                w-full
                border-gray-300
                dark:border-gray-700
                dark:bg-gray-900
                dark:text-gray-300
                focus:border-indigo-500
                dark:focus:border-emerald-600
                focus:ring-emerald-600
                rounded-3xl
                shadow-sm'
            ])
        !!}
        data-te-datepicker-toggle-ref
        data-te-datepicker-toggle-button-ref
    />
    <label
        for="floatingInput"
        class="pointer-events-none
            absolute
            left-3
            top-2
            mb-0
            max-w-[90%]
            origin-[0_0]
            truncate
            pt-[0.37rem]
            leading-[1.6]
            text-neutral-500
            transition-all
            duration-200
            ease-out
            peer-focus:-translate-y-[0.9rem]
            peer-focus:scale-[0.8]
            peer-focus:text-slate-500
            peer-data-[te-input-state-active]:-translate-y-[0.9rem]
            peer-data-[te-input-state-active]:scale-[0.8]
            motion-reduce:transition-none
            dark:text-slate-500
            dark:peer-focus:text-slate-500
        "
    >Дата рождения</label>
</div>
