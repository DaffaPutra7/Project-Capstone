@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#89FFE7] focus:ring-[#89FFE7] rounded-[50px] shadow-sm']) }}>
