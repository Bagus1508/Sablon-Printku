<x-app-layout>
    @section('title', 'Persediaan Kontrak Rinci Export')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Kontrak Rinci Export
            </h2>
        </div>
        <div>
            <div class="my-5">
                <div>
                    Data Tanggal :
                    {{$startDate}} - {{$endDate}}
                </div>
                <a href="{{route('export-monitoring-kontrak-rinci-all', ['tanggal' => $tanggal_kontrak_rinci,'proses_jahit_checkbox' => $proses_jahit_checkbox, 'proses_cutting_checkbox' => $proses_cutting_checkbox, 'proses_packing_checkbox' => $proses_packing_checkbox, 'no_kontrak_pihak_pertama'=>$no_kontrak_pihak_pertama, 'kode_perusahaan' => $kode_perusahaan ])}}">
                    <button type="button" class="mt-2 transition ease-in-out hover:bg-gray-100 hover:text-gray-950 inline-flex w-fit rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Export
                    </button>
                </a>
            </div>       
            <div class="max-w-full overflow-x-auto rounded-t-md">
                @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.export.preview')
            </div>
        </div>
    </div>
</x-app-layout>
