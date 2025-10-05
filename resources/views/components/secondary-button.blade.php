@props(['icon' => false])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 tracking-wide hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-150 ease-in-out shadow-sm hover:shadow gap-2']) }}>
    @if($icon)
        <span class="w-5 h-5">{{ $icon }}</span>
    @endif
    {{ $slot }}
</button>
