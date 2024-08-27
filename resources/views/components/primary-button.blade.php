<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-primary-50 tracking-wide hover:bg-accent-700 active:bg-accent-900 focus:outline-none transition']) }}>
    {{ $slot }}
</button>
