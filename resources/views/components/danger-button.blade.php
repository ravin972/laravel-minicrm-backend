@props(['icon' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white tracking-wide hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150 ease-in-out shadow-sm hover:shadow disabled:opacity-50 disabled:cursor-not-allowed gap-2']) }}>
    @if($icon)
        <span class="w-5 h-5">{{ $icon }}</span>
    @endif
    {{ $slot }}
</button>
