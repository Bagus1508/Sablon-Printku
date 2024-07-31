<x-app-layout>
    @section('title', 'Data Satuan')
    <div class="mt-4 md:flex md:items-center md:justify-between mx-10">
        <div class="min-w-0 flex-1">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Data Satuan</h2>
        </div>
    </div>
    <div class="mx-auto max-w-screen-2xl p-10 md:p-10 2xl:p-10 -mt-10">
        @livewire('unit-table')
    </div>
    @include('pages.dashboard.data_master.data_satuan.create')
</x-app-layout>

