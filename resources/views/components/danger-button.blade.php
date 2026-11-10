<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-150 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-60']) }}>
    {{ $slot }}
</button>
