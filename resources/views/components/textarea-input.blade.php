<textarea
    {!! $attributes->merge([
    'class' => '
        border-gray-300
        dark:border-gray-700
        dark:bg-gray-900
        dark:text-gray-300
        focus:border-indigo-500
        dark:focus:border-emerald-600
        focus:ring-emerald-600
        dark:focus:border-emerald-600
        rounded-3xl
        shadow-sm'
]) !!}>{{ $value }}</textarea>
