<x-app-layout>
    @section('title', 'Data Akun')
    <div class="mt-4 md:flex md:items-center md:justify-between mx-10">
        <div class="min-w-0 flex-1">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Data Bagian Unit Kerja</h2>
        </div>
    </div>
    <div class="mx-auto max-w-screen-2xl p-10 md:p-10 2xl:p-10 -mt-10">
        @livewire('account-table')
    </div>

    @include('pages.dashboard.data_master.data_akun.create')
</x-app-layout>
