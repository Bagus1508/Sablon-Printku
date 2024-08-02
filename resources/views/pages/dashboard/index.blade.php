<x-app-layout>
    @livewire('welcome-banner')

    @if ($loggedInUser->id_level_user === 1)        
    <dl class="mt-2 mx-10">
        {{-- <dt class=" bg-white dark:bg-boxdark rounded-lg">
            @livewire('loggedin-user')
        </dt> --}}
        <dt class=" bg-white dark:bg-boxdark rounded-lg">
            @livewire('log-activities')
        </dt>
    </dl>    
    @endif
</x-app-layout>