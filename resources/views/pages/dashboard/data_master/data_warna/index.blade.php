<x-app-layout>
    @section('title', 'Data Warna')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Warna
            </h2>
        </div>
        @livewire('color-table')
    </div>
    @include('pages.dashboard.data_master.data_warna.create')
</x-app-layout>
