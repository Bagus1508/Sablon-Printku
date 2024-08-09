<div>
    <div class="my-5">
        <form action="{{route('preview-export-monitoring-kontrak-global')}}" method="GET" class="flex mt-3 gap-x-3 max-sm:flex-col gap-5">
            <x-datepicker-range name="tanggal"/>
            <button type="submit" class="transition ease-in-out hover:bg-gray-100 hover:text-gray-950 inline-flex w-fit rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 justify-center my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Preview
            </button>
        </form>
    </div>        
    <section class="justify-between flex max-sm:flex-col-reverse max-sm:mb-5 mb-5 max-sm:gap-5">
        @include('livewire.search-data')
    </section>
    <div class="max-w-full overflow-x-auto rounded-t-md">
        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th rowspan="2" class="min-w-[50px] text-center font-medium text-white dark:text-white justify-center my-auto sticky bg-blue-600 left-0 dark:bg-meta-4">
                        No
                    </th>
                    <th width="400px" colspan="2" class="text-center font-medium text-white dark:text-white">
                        No Kontrak
                    </th>
                    <th rowspan="2" class="px-5 text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th width="200px" rowspan="2" class="text-center font-medium text-white dark:text-white">
                        Perusahaan
                    </th>
                    <th width="200px" rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Uraian Pekerjaan
                    </th>
                    <th width="200px" rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Nama Barang
                    </th>
                    <th rowspan="1" colspan="4" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Volume
                    </th>
                    @if ($loggedInUser->id_level_user === 1) 
                    <th rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Harga
                    </th>
                    <th rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        PPN ({{$dataPajak->ppn}}%)
                    </th>
                    <th rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Harga + PPN
                    </th>
                    @endif
                    <th rowspan="1" colspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Jangka Waktu Kontrak
                    </th>
                    <th rowspan="2" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        SPK Selesai
                    </th>
                </tr>
                <tr class="text-left dark:bg-meta-4">
                    <th width="200px" class="px-5 text-center font-medium text-white dark:text-white">
                        Takon
                    </th>
                    <th width="200px" class="px-5 whitespace-nowrap text-center font-medium text-white dark:text-white">
                        Pihak Pertama
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Satuan
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Kontrak
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Realisasi
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Sisa
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Awal
                    </th>
                    <th width="100px" class="px-5 text-center font-medium text-white dark:text-white">
                        Akhir
                    </th>
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($dataKontrak as $itemKontrak)
                    @php
                        $barangKontrakCount = $itemKontrak->barangKontrak->count();
                    @endphp                    
                    <tr>
                        <td rowspan="{{$barangKontrakCount}}" class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark sticky bg-blue-600 left-0 dark:bg-meta-4">
                            <h5 class="font-medium text-white dark:text-white">{{$loop->index + 1}}</h5>
                        </td>
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->takon}}</p>
                        </td>
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->no_kontrak_pihak_pertama ?? ''}}</p>
                        </td>
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">                    
                                @if($itemKontrak->tanggal_kontrak && $itemKontrak->tanggal_kontrak)
                                    {{ \Carbon\Carbon::parse($itemKontrak->tanggal_kontrak)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </td>
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$itemKontrak->perusahaan->nama_perusahaan ?? '-'}}</p>
                        </td>
                        <td rowspan="{{$barangKontrakCount}}" class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white text-left">{{$itemKontrak->uraian ?? '-'}}</p>
                        </td>
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                            <p class="text-black dark:text-white">{{$itemKontrak->barangKontrak->first()->dataProduk->nama_barang ?? '-'}}</p>
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark  text-center">
                            <p class="text-black dark:text-white">{{$itemKontrak->barangKontrak->first()->satuan->nama_satuan ?? '-'}}</p>
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                            <p class="text-black dark:text-white">{{$itemKontrak->barangKontrak->first()->volume_kontrak ?? '-'}}</p>
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                            <p class="text-black dark:text-white">{{$itemKontrak->barangKontrak->first()->volume_realisasi ?? '-'}}</p>
                        </td>    
                        <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                            <p class="text-black dark:text-white">{{$itemKontrak->barangKontrak->first()->volume_sisa ?? '-'}}</p>
                        </td>
                        @if ($loggedInUser->id_level_user === 1)   
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                            <p class="text-black dark:text-white px-10">
                                {{ $itemKontrak->total_harga !== null ? 'Rp ' . number_format($itemKontrak->total_harga, 0, ',', '.') : '-' }}
                            </p>
                        </td>
                        {{-- PPN --}}
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark">
                            <p class="text-black dark:text-white hover:underline">
                                Rp. {{ number_format(($itemKontrak->total_harga/100)*$dataPajak->ppn, 2, ',', '.') }}
                            </p>
                        </td>
                        {{-- Total Harga + PPN --}}
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark">
                            <p class="text-black dark:text-white hover:underline">
                                Rp. {{ number_format($itemKontrak->total_harga + ($itemKontrak->total_harga/100)*$dataPajak->ppn, 2, ',', '.') }}
                            </p>
                        </td>    
                        @endif
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                            <p class="text-black dark:text-white px-10">                    
                                @if($itemKontrak->awal_kr && $itemKontrak->awal_kr)
                                    {{ \Carbon\Carbon::parse($itemKontrak->awal_kr)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </td>   
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                            <p class="text-black dark:text-white px-10">                    
                                @if($itemKontrak->akhir_kr && $itemKontrak->akhir_kr)
                                    {{ \Carbon\Carbon::parse($itemKontrak->akhir_kr)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </td>   
                        <td rowspan="{{$barangKontrakCount}}" class="whitespace-nowrap text-center border-black dark:border-strokedark">
                            <p class="text-black dark:text-white px-10">
                                @if ($itemKontrak->kontrakGlobal->status_spk === 0)
                                    @include('components.badges.belum-selesai')
                                @else
                                    @include('components.badges.selesai')
                                @endif
                                <button 
                                data-hs-overlay="#modal-update-status-spk"
                                data-id-kontrak-global="{{$itemKontrak->kontrakGlobal->id}}"
                                data-no-kontrak-takon="{{$itemKontrak->takon}}"
                                data-status-spk="{{$itemKontrak->kontrakGlobal->status_spk}}"
                                id="update-status-spk" class="update-status-spk text-blue-600 hover:underline">Update</button>
                            </p>
                        </td>   
                    </tr>
                    @foreach ($itemKontrak->barangKontrak as $itemBarang)  
                    @if($loop->first)
                        @continue
                    @endif    
                        <tr>
                            <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                                <p class="text-black dark:text-white">{{$itemBarang->dataProduk->nama_barang}}</p>
                            </td>    
                            <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                                <p class="text-black dark:text-white">{{$itemBarang->satuan->nama_satuan}}</p>
                            </td>    
                            <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                                <p class="text-black dark:text-white">{{$itemBarang->volume_kontrak}}</p>
                            </td>    
                            <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                                <p class="text-black dark:text-white">{{$itemBarang->volume_realisasi}}</p>
                            </td>    
                            <td class="whitespace-nowrap border-b border-slate-300 dark:border-strokedark text-center">
                                <p class="text-black dark:text-white">{{$itemBarang->volume_sisa}}</p>
                            </td>
                        </tr>
                    @endforeach
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

    {{$dataKontrak->links()}}

    {{-- Status SPK Update --}}
    @include('pages.dashboard.monitoring_kontrak.kontrak_global.status_spk.edit')
</div>