<x-app-layout>
    @section('title', 'Persediaan Bahan Baku')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Bahan Baku Global
            </h2>
        </div>
        @livewire('bahan-baku-global-table')
    </div>
</x-app-layout>
