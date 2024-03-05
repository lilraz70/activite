<x-app-layout>
    @push('styles')
        @livewireStyles
    @endpush
    @livewire('back.activities.show', ['activity' => $activity])
    @push('scripts')
        @vite(['resources/js/custom/app-email.js'])
        @livewireScripts
    @endpush
</x-app-layout>
