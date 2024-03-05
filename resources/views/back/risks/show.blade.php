<x-app-layout>
    @push('styles')
        @livewireStyles
    @endpush
    @livewire('back.risk.show', ['risk' => $risk])
    @push('scripts')
        @vite(['resources/js/custom/app-email.js'])
        @livewireScripts
    @endpush
</x-app-layout>
