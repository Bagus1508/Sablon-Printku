<x-app-layout>
    @section('title', 'Data Ukuran')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Ukuran
            </h2>
        </div>
        @livewire('size-table')
    </div>
    @include('pages.dashboard.data_master.data_ukuran.create')
</x-app-layout>
