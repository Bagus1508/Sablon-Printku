<x-app-layout>
    @livewire('welcome-banner')

    <dl class="mt-2 mx-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-col-3 gap-2">
        <dt class=" bg-white dark:bg-boxdark rounded-lg">
            @livewire('loggedin-user')
        </dt>
        <dt class=" bg-white dark:bg-boxdark rounded-lg">
            @livewire('log-activities')
        </dt>
    </dl>    
</x-app-layout>