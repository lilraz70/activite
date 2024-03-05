<x-app-layout>
    @push('styles')
        @livewireStyles
    @endpush
    @livewire('back.collaborators.show', ['collaborator' => $collaborator])
    @push('scripts')
        @vite(['resources/js/custom/app-email.js'])
        @livewireScripts
    @endpush
</x-app-layout>
