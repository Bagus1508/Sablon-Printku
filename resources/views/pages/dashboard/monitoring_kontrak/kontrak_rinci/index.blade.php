<x-app-layout>
    @section('title', 'Monitoring Kontrak Rinci')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Monitoring Kontrak Rinci
            </h2>
        </div>
        @livewire('monitoring-kontrak-rinci-table')
    </div>
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.create')
</x-app-layout>
