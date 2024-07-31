
<x-app-layout>
    @section('title', 'Persediaan Bahan Baku Export')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Bahan Baku Satuan Export
            </h2>
        </div>
        <div>
            <div class="my-5">
                <div>
                    Data Tanggal :
                    {{$tgl_stok_satuan}}
                </div>
                @if(isset($tgl_stok_satuan))
                    <a href="{{route('export-bahan-baku-stok-satuan', ['tanggal' => $tgl_stok_satuan,'id_satuan' => $id_satuan])}}">
                        <button type="button" class="mt-2 transition ease-in-out hover:bg-gray-100 hover:text-gray-950 inline-flex w-fit rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Export
                        </button>
                    </a>
                @else
                    <p>Rentang tanggal tidak tersedia.</p> <!-- Pesan alternatif jika variabel tidak ada -->
                @endif
            </div>       
            <div class="max-w-full overflow-x-auto rounded-t-md">
                @include('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.export.preview')
            </div>
            <section class="place-items-center py-10 sm:py-10 lg:px-8
                @if ($nodata!=false)
                {{'grid'}}
                @else
                {{'hidden'}}
                @endif
                ">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Data Tidak Ditemukan!</h3>
                        <p class="mt-1 text-sm text-gray-500">Maaf, data yang Anda cari tidak ada</p>
                    </div>
            </section>
        </div>
    </div>
</x-app-layout>