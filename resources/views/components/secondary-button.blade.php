<button 
    {{ $attributes->merge([
        'type' => 'button', 
        'class' => '
            inline-flex items-center 
            px-4 py-2 
            bg-white 
            border border-[#89FFE7] 
            rounded-[50px] 
            font-semibold text-xs text-[#2E7099] uppercase tracking-widest 
            shadow-sm 
            hover:bg-[#89FFE7] hover:text-white 
            focus:bg-[#2E7099] focus:text-white 
            active:bg-[#2E7099] active:text-white 
            focus:outline-none focus:ring-2 focus:ring-[#89FFE7] focus:ring-offset-2 
            disabled:opacity-25 
            transition ease-in-out duration-150
        '
    ]) }}
>
    {{ $slot }}
</button>
