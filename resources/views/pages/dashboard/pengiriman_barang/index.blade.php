<x-app-layout>
    @section('title', 'Pengiriman Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Pengiriman Barang
            </h2>
        </div>
        @livewire('pengiriman-barang-table')
    </div>
    
</x-app-layout>
