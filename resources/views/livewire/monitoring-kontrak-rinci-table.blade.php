<div>
    {{-- <div class="my-5">
        <form action="{{route('preview-export-stok-global')}}" method="GET" class="flex mt-3 gap-x-3 max-sm:flex-col gap-5">
            <x-datepicker-range name="tanggal"/>
            <button type="submit" class="transition ease-in-out hover:bg-gray-100 hover:text-gray-950 inline-flex w-fit rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 justify-center my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Preview
            </button>
        </form>
    </div>     --}}    
    <section class="justify-between flex max-sm:flex-col-reverse max-sm:mb-5">
        @include('livewire.search-data')
        <div class="my-5">
            <button data-hs-overlay="#modal-create-kontrak-rinci" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah Data</button>
        </div>
    </section>
    <div class="max-w-full overflow-x-auto rounded-t-md">
        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th rowspan="3" class="min-w-[50px] border-r border-[#eee] text-center font-medium text-white dark:text-white justify-center my-auto">
                        No
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi Kontrak
                    </th>
                    <th width="400px" colspan="2" class="border-r border-b border-[#eee] text-center font-medium text-white dark:text-white">
                        No Kontrak
                    </th>
                    <th rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Kontrak
                    </th>
                    <th rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        No Kontrak Rinci
                    </th>
                    <th rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Kontrak Rinci
                    </th>
                    <th colspan="3" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Jangka Waktu Kontrak Rinci
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Uraian
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Item Barang
                    </th>
                    <th width="200px"  rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Qty
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Satuan
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Harga
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Total Harga
                    </th>
                    <th width="200px" rowspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi Barang
                    </th>
                    <th colspan="3" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Proses Cutting
                    </th>
                    <th colspan="3" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Proses Jahit
                    </th>
                    <th colspan="3" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Packing
                    </th>
                    <th width="200px" colspan="10" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Status Kontrak
                    </th>
                    <th width="200px" colspan="5" class="border-r border-b border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Status Invoice
                    </th>
                </tr>
                <tr class="text-left dark:bg-meta-4">
                    {{-- Data Kontrak --}}
                    <th width="200px" rowspan="2" class="border-r border-[#eee] px-5 text-center font-medium text-white dark:text-white">
                        Takon
                    </th>
                    <th width="200px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        HP
                    </th>
                    {{-- Jangka Waktu Kontrak Rinci --}}
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Masa KR
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Awal KR
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Akhir KR
                    </th>
                    {{-- Proses Cutting --}}
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Masuk
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Selesai
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Durasi
                    </th>
                    {{-- Proses jahit --}}
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Masuk
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Selesai
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Durasi
                    </th>
                    {{-- Proses Packing --}}
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Masuk
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Selesai
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 py-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Durasi
                    </th>
                    {{-- Status Kontrak --}}
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Pengiriman
                    </th>
                    <th width="100px" colspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        BA RIKMATEK
                    </th>
                    <th width="100px" colspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        BAPB/BAPP
                    </th>
                    <th width="100px" colspan="3" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        BAST
                    </th>
                    {{-- Status Invoice --}}
                    <th width="100px" colspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Invoice
                    </th>
                    <th width="100px" colspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Resi Pengiriman
                    </th>
                    <th width="100px" rowspan="2" class="border-r border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi
                    </th>
                </tr>
                <tr>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        No
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        No
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        No
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Aksi
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Nomor
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Foto
                    </th>
                    <th width="100px" class="border-x border-t border-[#eee] px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Tanggal Pengiriman
                    </th>
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($dataKontrakRinci as $itemKontrak)                    
                    <tr>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <h5 class="font-medium text-black dark:text-white">{{$loop->index + 1 }}</h5>
                        </td>
                        <td class="mx-auto px-4 py-5 border-b border-[#eee] dark:border-strokedark">
                            <div class="flex items-center mx-auto justify-center">
                                <a title="Export Detail Data" href="{{route('monitoring-kontrak-rinci.preview_export', $itemKontrak->id)}}"
                                    class="transition ease-in-out hover:bg-amber-50 focus:bg-amber-50 hover:text-amber-500 focus:text-amber-500 inline-flex w-fit rounded-l-md p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-amber-500 focus:ring-2 focus:ring-amber-500 sm:text-sm sm:leading-6">
                                    <svg class="w-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><title>file_type_excel2</title><path d="M28.781,4.405H18.651V2.018L2,4.588V27.115l16.651,2.868V26.445H28.781A1.162,1.162,0,0,0,30,25.349V5.5A1.162,1.162,0,0,0,28.781,4.405Zm.16,21.126H18.617L18.6,23.642h2.487v-2.2H18.581l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2H28.941Z" style="fill:#20744a;fill-rule:evenodd"/><rect x="22.487" y="7.439" width="4.323" height="2.2" style="fill:#20744a"/><rect x="22.487" y="10.94" width="4.323" height="2.2" style="fill:#20744a"/><rect x="22.487" y="14.441" width="4.323" height="2.2" style="fill:#20744a"/><rect x="22.487" y="17.942" width="4.323" height="2.2" style="fill:#20744a"/><rect x="22.487" y="21.443" width="4.323" height="2.2" style="fill:#20744a"/><polygon points="6.347 10.673 8.493 10.55 9.842 14.259 11.436 10.397 13.582 10.274 10.976 15.54 13.582 20.819 11.313 20.666 9.781 16.642 8.248 20.513 6.163 20.329 8.585 15.666 6.347 10.673" style="fill:#ffffff;fill-rule:evenodd"/></svg>
                                </a>
                                <button title="Edit Data" data-hs-overlay="#modal-edit-kontrak-rinci" type="button"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-takon="{{$itemKontrak->takon}}"
                                    data-no-telepon="{{$itemKontrak->no_telepon}}"
                                    data-tanggal-kontrak="{{$itemKontrak->tanggal_kontrak}}"
                                    data-id-perusahaan="{{$itemKontrak->id_perusahaan}}"
                                    data-no-kontrak-rinci="{{$itemKontrak->no_kontrak_rinci}}"
                                    data-tanggal-kr="{{$itemKontrak->tanggal_kr}}"
                                    data-awal-kr="{{$itemKontrak->awal_kr}}"
                                    data-akhir-kr="{{$itemKontrak->akhir_kr}}"
                                    data-uraian="{{$itemKontrak->uraian}}"
                                    id="edit-kontrak-rinci"
                                    class="edit-kontrak-rinci transition ease-in-out border-l hover:bg-amber-50 focus:bg-amber-50 hover:text-amber-500 focus:text-amber-500 inline-flex w-fit p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-amber-500 focus:ring-2 focus:ring-amber-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button title="Hapus Data" data-hs-overlay="#modal-delete-kontrak-rinci" type="button"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-no-kontrak-rinci="{{$itemKontrak->no_kontrak_rinci}}"
                                    id="hapus-kontrak-rinci"
                                    class="hapus-kontrak-rinci transition ease-in-out hover:bg-rose-50 border-l rounded-r-md focus:bg-rose-50 hover:text-rose-500 focus:text-rose-500 inline-flex w-fit  p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-rose-500 focus:ring-2 focus:ring-rose-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                        {{-- Data Kontrak --}}
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->takon}}</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->no_telepon}}</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ \Carbon\Carbon::parse($itemKontrak->tanggal_kontrak)->translatedFormat('d F Y') }}</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->no_kontrak_rinci}}</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ \Carbon\Carbon::parse($itemKontrak->tanggal_kr)->translatedFormat('d F Y') }}</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ \Carbon\Carbon::parse($itemKontrak->awal_kr)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($itemKontrak->akhir_kr)->translatedFormat('d F Y') }} <br> ({{ \Carbon\Carbon::parse($itemKontrak->awal_kr)->diffInDays(\Carbon\Carbon::parse($itemKontrak->akhir_kr)) }} Hari)</p>
                        </td>
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white text-left">{{ \Carbon\Carbon::parse($itemKontrak->awal_kr)->translatedFormat('d F Y') }}</p>
                        </td>   
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white text-left">{{ \Carbon\Carbon::parse($itemKontrak->akhir_kr)->translatedFormat('d F Y') }}</p>
                        </td>   
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white text-left">{{$itemKontrak->uraian}}</p>
                        </td>
                        {{-- Item Barang --}}
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto">
                            @foreach ($itemKontrak->barangKontrak as $barang)
                                <p class="text-black dark:text-white text-left border-b border-slate-400 px-10">{{$barang->nama_barang}} </p>
                            @endforeach
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto">
                            @foreach ($itemKontrak->barangKontrak as $barang)
                                <p class="text-black dark:text-white text-left border-b border-slate-400 px-10">{{$barang->kuantitas}}</p>
                            @endforeach
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto">
                            @foreach ($itemKontrak->barangKontrak as $barang)
                                <p class="text-black dark:text-white text-left border-b border-slate-400 px-10">{{$barang->satuan->nama_satuan}}</p>
                            @endforeach
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto">
                            @foreach ($itemKontrak->barangKontrak as $barang)
                                <p class="text-black dark:text-white text-left border-b border-slate-400 px-10">
                                    Rp. {{ number_format($barang->harga_barang, 2, ',', '.') }}
                                </p>
                            @endforeach
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto">
                            @foreach ($itemKontrak->barangKontrak as $barang)
                            <p class="text-black dark:text-white text-left border-b border-slate-400 px-10">
                                <button
                                data-hs-overlay="#modal-edit-barang"
                                data-id-barang-kontrak="{{$barang->id}}"
                                data-nama-barang-kontrak="{{$barang->nama_barang}}"
                                data-kuantitas-barang-kontrak="{{$barang->kuantitas}}"
                                data-id-satuan-kontrak="{{$barang->satuan->id}}"
                                data-volume-kontrak="{{$barang->volume_kontrak}}"
                                data-volume-realisasi-kontrak="{{$barang->volume_realisasi}}"
                                data-volume-sisa-kontrak="{{$barang->volume_sisa}}"
                                data-harga-barang-kontrak="{{$barang->harga_barang}}"
                                id="edit-barang-kontrak"
                                class="edit-barang-kontrak text-blue-600 hover:underline">Edit</button>
                                |
                                <button
                                data-hs-overlay="#modal-hapus-barang"
                                data-id-barang-kontrak="{{$barang->id}}"
                                data-nama-barang-kontrak="{{$barang->nama_barang}}"
                                id="hapus-barang-kontrak"
                                class="hapus-barang-kontrak text-red-600 hover:underline">Hapus</button>
                            </p>
                            @endforeach
                        </td>    
                        {{-- Harga --}}
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark">
                            <p class="text-black dark:text-white hover:underline">
                                Rp. {{ number_format($itemKontrak->total_harga, 2, ',', '.') }}
                            </p>
                        </td>
                        {{-- Tombol Tambah Barang --}}                           
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark items-center mx-auto px-10">
                            <button
                                data-hs-overlay="#modal-tambah-barang"
                                data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                id="tambah-barang-kontrak"
                                class="barang-kontrak text-blue-600 hover:underline">+ Tambah Barang</button>
                        </td>    
                        {{-- Proses Cutting --}}
                        @if ($itemKontrak->prosesCutting->durasi == null && $itemKontrak->prosesCutting->tanggal_masuk == null && $itemKontrak->prosesCutting->tanggal_selesai == null)
                            <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <button 
                                    data-hs-overlay="#modal-edit-proses-cutting"
                                    data-id-proses-cutting="{{$itemKontrak->prosesCutting->id}}"
                                    data-tanggal-masuk="{{$itemKontrak->prosesCutting->tanggal_masuk}}"
                                    data-tanggal-selesai="{{$itemKontrak->prosesCutting->tanggal_selesai}}"
                                    id="proses-cutting" class="proses-cutting text-blue-600 hover:underline">Update</button>
                            </td>
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesCutting->tanggal_masuk}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesCutting->tanggal_selesai}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if ($itemKontrak->prosesCutting->durasi != null)                                
                                    <p class="text-black dark:text-white">{{$itemKontrak->prosesCutting->durasi}} Hari</p>
                                @endif
                                @if ($itemKontrak->prosesCutting->tanggal_masuk != null || $itemKontrak->prosesCutting->tanggal_selesai != null)                                    
                                    <button 
                                        data-hs-overlay="#modal-edit-proses-cutting"
                                        data-id-proses-cutting="{{$itemKontrak->prosesCutting->id}}"
                                        data-tanggal-masuk="{{$itemKontrak->prosesCutting->tanggal_masuk}}"
                                        data-tanggal-selesai="{{$itemKontrak->prosesCutting->tanggal_selesai}}"
                                        id="proses-cutting" class="proses-cutting text-blue-600 hover:underline">Edit</button>
                                @endif
                            </td>       
                        @endif
                        {{-- Proses Jahit --}}
                        @if ($itemKontrak->prosesJahit->durasi == null && $itemKontrak->prosesJahit->tanggal_masuk == null && $itemKontrak->prosesJahit->tanggal_selesai == null)
                            <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <button 
                                    data-hs-overlay="#modal-edit-proses-jahit"
                                    data-id-proses-jahit="{{$itemKontrak->prosesJahit->id}}"
                                    data-tanggal-masuk="{{$itemKontrak->prosesJahit->tanggal_masuk}}"
                                    data-tanggal-selesai="{{$itemKontrak->prosesJahit->tanggal_selesai}}"
                                    id="proses-jahit" class="proses-jahit text-blue-600 hover:underline">Update</button>
                            </td>   
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesJahit->tanggal_masuk}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesJahit->tanggal_selesai}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if ($itemKontrak->prosesJahit->durasi != null)                                
                                    <p class="text-black dark:text-white">{{$itemKontrak->prosesJahit->durasi}} Hari</p>
                                @endif
                                @if ($itemKontrak->prosesJahit->tanggal_masuk != null || $itemKontrak->prosesJahit->tanggal_selesai != null)
                                    <button 
                                    data-hs-overlay="#modal-edit-proses-jahit"
                                    data-id-proses-jahit="{{$itemKontrak->prosesJahit->id}}"
                                    data-tanggal-masuk-jahit="{{$itemKontrak->prosesJahit->tanggal_masuk}}"
                                    data-tanggal-selesai-jahit="{{$itemKontrak->prosesJahit->tanggal_selesai}}"
                                    id="proses-jahit" class="proses-jahit text-blue-600 hover:underline">Edit</button>  
                                @endif
                            </td>       
                        @endif       
                        {{-- Proses Packing --}}
                        @if ($itemKontrak->prosesPacking->tanggal_mulai == null && $itemKontrak->prosesPacking->tanggal_masuk == null && $itemKontrak->prosesPacking->tanggal_selesai == null)
                        <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                            <button 
                                data-hs-overlay="#modal-edit-proses-packing"
                                data-id-proses-packing="{{$itemKontrak->prosesPacking->id}}"
                                data-tanggal-masuk-packing="{{$itemKontrak->prosesPacking->tanggal_masuk}}"
                                data-tanggal-selesai-packing="{{$itemKontrak->prosesPacking->tanggal_selesai}}"
                                id="proses-packing" class="proses-packing text-blue-600 hover:underline">Update</button>
                        </td> 
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesPacking->tanggal_masuk}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$itemKontrak->prosesPacking->tanggal_selesai}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if ($itemKontrak->prosesPacking->durasi != null)                                
                                    <p class="text-black dark:text-white">{{$itemKontrak->prosesPacking->durasi}} Hari</p>
                                @endif
                                @if ($itemKontrak->prosesPacking->tanggal_masuk != null || $itemKontrak->prosesPacking->tanggal_selesai != null)
                                    <button 
                                    data-hs-overlay="#modal-edit-proses-packing"
                                    data-id-proses-packing="{{$itemKontrak->prosesPacking->id}}"
                                    data-tanggal-masuk-packing="{{$itemKontrak->prosesPacking->tanggal_masuk}}"
                                    data-tanggal-selesai-packing="{{$itemKontrak->prosesPacking->tanggal_selesai}}"
                                    id="proses-packing" class="proses-packing text-blue-600 hover:underline">Edit</button>
                                @endif
                            </td>       
                        @endif 
                        {{-- Status Kontrak --}}
                        <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">
                                @if (is_null($itemKontrak->pengirimanBarang))
                                    @include('components.badges.belum-selesai')
                                @else
                                    @include('components.badges.selesai')
                                @endif
                                <button
                                data-hs-overlay="#modal-update-pengiriman"
                                data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                data-no-surat-jalan="{{$itemKontrak->pengirimanBarang->no_surat_jalan ?? ''}}"
                                data-tanggal-surat-jalan="{{$itemKontrak->pengirimanBarang->tanggal_surat_jalan ?? ''}}"
                                data-bukti-foto="{{$itemKontrak->pengirimanBarang->bukti_foto ?? ''}}"
                                data-id-ekspedisi="{{$itemKontrak->pengirimanBarang->id_ekspedisi ?? ''}}"
                                data-id-region="{{$itemKontrak->pengirimanBarang->id_region ?? ''}}"
                                id="update-pengiriman"
                                class="update-pengiriman text-blue-600 hover:underline">Edit</button>
                            </p>
                        </td>
                        {{-- BA RIKMATEK --}}
                        @if (is_null($itemKontrak->ba_rikmatek))
                            <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <button 
                                    data-hs-overlay="#modal-edit-ba-rikmatek"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-ba-rikmatek="{{$itemKontrak->ba_rikmatek->id ?? ''}}"
                                    data-no-ba-rikmatek="{{$itemKontrak->ba_rikmatek->no ?? ''}}"
                                    data-tanggal-ba-rikmatek="{{$itemKontrak->ba_rikmatek->tanggal_ba_rikmatek ?? ''}}"
                                    id="proses-ba-rikmatek" class="proses-ba-rikmatek text-blue-600 hover:underline">Update</button>
                            </td>   
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->ba_rikmatek->no}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->ba_rikmatek->tanggal_ba_rikmatek}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if (isset($itemKontrak->ba_rikmatek) && $itemKontrak->ba_rikmatek->tanggal_ba_rikmatek != null)
                                    <button 
                                    data-hs-overlay="#modal-edit-ba-rikmatek"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-ba-rikmatek="{{$itemKontrak->ba_rikmatek->id ?? ''}}"
                                    data-no-ba-rikmatek="{{$itemKontrak->ba_rikmatek->no ?? ''}}"
                                    data-tanggal-ba-rikmatek="{{$itemKontrak->ba_rikmatek->tanggal_ba_rikmatek ?? ''}}"
                                    id="proses-ba-rikmatek" class=" px-10 proses-ba-rikmatek text-blue-600 hover:underline">Edit</button>  
                                @endif
                            </td>       
                        @endif     
                        {{-- BAPP/BAPB --}}
                        @if (is_null($itemKontrak->bapb_bapp))
                            <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <button 
                                    data-hs-overlay="#modal-edit-bapb-bapp"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-bapb-bapp="{{$itemKontrak->bapb_bapp->id ?? ''}}"
                                    data-no-bapb-bapp="{{$itemKontrak->bapb_bapp->no ?? ''}}"
                                    data-tanggal-bapb-bapp="{{$itemKontrak->bapb_bapp->tanggal_bapb_bapp ?? ''}}"
                                    id="proses-bapb-bapp" class="proses-bapb-bapp text-blue-600 hover:underline">Update</button>
                            </td>   
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->bapb_bapp->no}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->bapb_bapp->tanggal_bapb_bapp}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if (isset($itemKontrak->bapb_bapp) && $itemKontrak->bapb_bapp->tanggal_bapb_bapp != null)
                                <button 
                                    data-hs-overlay="#modal-edit-bapb-bapp"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-bapb-bapp="{{$itemKontrak->bapb_bapp->id ?? ''}}"
                                    data-no-bapb-bapp="{{$itemKontrak->bapb_bapp->no ?? ''}}"
                                    data-tanggal-bapb-bapp="{{$itemKontrak->bapb_bapp->tanggal_bapb_bapp ?? ''}}"
                                    id="proses-bapb-bapp" class="proses-bapb-bapp text-blue-600 hover:underline">Edit</button>
                                @endif
                            </td>       
                        @endif     
                        {{-- BAST --}}
                        @if (is_null($itemKontrak->bast))
                            <td colspan="3" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <button 
                                    data-hs-overlay="#modal-edit-bast"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-bast="{{$itemKontrak->bast->id ?? ''}}"
                                    data-no-bast="{{$itemKontrak->bast->no ?? ''}}"
                                    data-tanggal-bast="{{$itemKontrak->bast->tanggal_bast ?? ''}}"
                                    id="proses-bast" class="proses-bast text-blue-600 hover:underline">Update</button>
                            </td>   
                        @else                            
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->bast->no}}</p>
                            </td>    
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                <p class="text-black dark:text-white px-10">{{$itemKontrak->bast->tanggal_bast}}</p>
                            </td>   
                            <td class="whitespace-nowrap text-center border-black dark:border-strokedark">
                                @if (isset($itemKontrak->bast) && $itemKontrak->bast->tanggal_bast != null)
                                    <button 
                                    data-hs-overlay="#modal-edit-bast"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-bast="{{$itemKontrak->bast->id ?? ''}}"
                                    data-no-bast="{{$itemKontrak->bast->no ?? ''}}"
                                    data-tanggal-bast="{{$itemKontrak->bast->tanggal_bast ?? ''}}"
                                    id="proses-bast" class="px-10 proses-bast text-blue-600 hover:underline">Edit</button>  
                                @endif
                            </td>       
                        @endif     
                        {{-- Status Pengiriman --}}
                        @if (is_null($itemKontrak->invoice))
                            <td colspan="5" class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                    <button
                                    data-hs-overlay="#modal-update-invoice"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-invoice="{{$itemKontrak->invoice->id ?? ''}}"
                                    data-no-invoice="{{$itemKontrak->invoice->nomor_invoice ?? ''}}"
                                    data-tanggal-invoice="{{$itemKontrak->invoice->tanggal_invoice ?? ''}}"
                                    data-foto-invoice="{{$itemKontrak->invoice->foto_invoice ?? ''}}"
                                    data-tanggal-kirim-invoice="{{$itemKontrak->invoice->tanggal_kirim_invoice ?? ''}}"
                                    id="update-invoice"
                                    class="update-invoice text-blue-600 hover:underline">Update</button>
                            </td>
                        @else
                            <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                {{$itemKontrak->invoice->nomor_invoice}}
                            </td>
                            <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                {{$itemKontrak->invoice->tanggal_invoice}}
                            </td>
                            <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <button
                                data-hs-overlay="#modal-show-invoice"
                                data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                data-id-invoice="{{$itemKontrak->invoice->id ?? ''}}"
                                data-foto-invoice="{{$itemKontrak->invoice->foto_invoice ?? ''}}"
                                id="show-invoice"
                                class="show-invoice text-blue-600 hover:underline">{{$itemKontrak->invoice->foto_invoice}}</button>

                            </td>
                            <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                {{$itemKontrak->invoice->tanggal_kirim_invoice}}
                            </td>
                            <td class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                    <button
                                    data-hs-overlay="#modal-update-invoice"
                                    data-id-kontrak-rinci="{{$itemKontrak->id}}"
                                    data-id-invoice="{{$itemKontrak->invoice->id ?? ''}}"
                                    data-no-invoice="{{$itemKontrak->invoice->nomor_invoice ?? ''}}"
                                    data-tanggal-invoice="{{$itemKontrak->invoice->tanggal_invoice ?? ''}}"
                                    data-foto-invoice="{{$itemKontrak->invoice->foto_invoice ?? ''}}"
                                    data-tanggal-kirim-invoice="{{$itemKontrak->invoice->tanggal_kirim_invoice ?? ''}}"
                                    id="update-invoice"
                                    class="update-invoice text-blue-600 hover:underline">Edit</button>
                            </td>
                        @endif        
                    </tr>
                @endforeach
            </tbody>
        </table>

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

    {{$dataKontrakRinci->links()}}

    {{-- Kontrak Rinci --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.delete')

    {{-- Status Kontrak --}}
    {{-- Pengiriman Barang --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.pengiriman_barang.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.ba_rikmatek.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.bapb_bapp.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.bast.edit')

    {{-- Invoice --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.invoice.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.invoice.show_image')

    {{-- Barang Kontrak --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.barang_kontrak.create')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.barang_kontrak.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.barang_kontrak.delete')

    {{-- Proses Pekerjaan --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.proses_pekerjaan.proses_cutting.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.proses_pekerjaan.proses_jahit.edit')
    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.proses_pekerjaan.proses_packing.edit')
</div>
