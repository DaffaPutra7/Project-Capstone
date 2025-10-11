<button 
    {{ $attributes->merge([
        'type' => 'submit', 
        'class' => '
            inline-flex items-center 
            px-4 py-2 
            bg-[#2E7099] 
            border border-transparent 
            rounded-[50px] 
            font-semibold text-xs text-white uppercase tracking-widest 
            hover:bg-[#256084]
            active:bg-white active:text-[#2E7099]
            focus:bg-white focus:text-[#2E7099]
            focus:outline-none focus:ring-2 focus:ring-[#89FFE7] focus:ring-offset-2 
            transition ease-in-out duration-150
        '
    ]) }}
>
    {{ $slot }}
</button>
