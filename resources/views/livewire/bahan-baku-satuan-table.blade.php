<div>
    <section class="justify-between flex max-sm:flex-col-reverse max-sm:mb-5 mb-5 max-sm:gap-5">
        @include('livewire.search-data')
        <div class="my-5">
            <button data-hs-overlay="#modal-create-produk" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah Bahan</button>
        </div>
    </section>
    <div class="my-5">
        <form action="{{route('preview-export-stok-satuan')}}" method="GET" class="flex mt-3 gap-x-3 max-sm:flex-col gap-5">
            <x-datepicker-range name="tanggal"/>
            <section class="flex gap-3">
                <!-- Pilihan Satuan -->
                <div class="mb-4">
                    <label for="unit" class="block text-sm font-medium text-gray-700">Pilih Satuan</label>
                    <select wire:model.lazy='selectedUnit' id="unit" name="id_satuan" class="dark:bg-boxdark ring-1 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm rounded-md">
                        <option selected>Default</option>
                        <option value="1">Meter</option>
                        <option value="2">Yard</option>
                    </select>
                </div>
            </section>
            <div class="hs-dropdown relative inline-flex [--auto-close:inside]">
                <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-3 px-4 my-auto inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Preview
                </button>
              
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 px-4 py-4 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-1 space-y-0.5 gap-4 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <select wire:model.lazy='selectedTable' id="selected_table" name="selected_table" class="dark:bg-boxdark ring-1 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm rounded-md">
                        <option value="tabel_persediaan" selected>Tabel Persediaan</option>
                        @if ($loggedInUser->id_level_user == 1)                            
                        <option value="tabel_harga">Tabel Harga</option>
                        <option value="tabel_persediaan_harga">Tabel Persediaan dan Harga</option>
                        @endif
                    </select>
                    <div class="flex justify-end"> 
                        <button type="submit" class=" bg-blue-600 px-2 py-1 rounded-md text-white mt-3">Preview</button>
                    </div>
                </div>
            </div>
        </form>
    </div>        
    <div class="max-w-full overflow-x-auto rounded-t-md">
        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th rowspan="3" class="min-w-[50px] text-center px-4 py-4 font-medium text-white dark:text-white sticky left-0 border-b bg-blue-600 border-white dark:bg-meta-4">
                        No
                    </th>
                    <th rowspan="3" class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Aksi
                    </th>
                    <th rowspan="3" class="text-center px-4 py-4 font-medium text-white dark:text-white">
                        NO ID
                    </th>
                    <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Nama Barang
                    </th>
                    <th rowspan="3" class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Warna
                    </th>
                    <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Kode Warna
                    </th>
                    <th colspan="{{$jumlahHari*2}}" class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                    <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Total Kain Masuk
                    </th>
                    <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Total Kain Keluar
                    </th>
                    <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Total Sisa Kain
                    </th>
                </tr>
                <tr>
                    @foreach ($dateRange as $item)                        
                    <th colspan="2" class="text-center font-medium text-white dark:text-white border dark:bg-meta-4">
                        {{$item}}{{-- //tanggalnya --}}
                    </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($dateRange as $item)                        
                        <th class="px-2 text-center font-medium bg-green-800 text-white dark:text-white border">
                            Masuk
                        </th>
                        <th class="px-2 text-center font-medium bg-red-600 text-white dark:text-white border">
                            Keluar
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($data as $item)                    
                    <tr>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark sticky left-0 bg-blue-600 dark:bg-meta-4">
                            <h5 class="font-medium text-white dark:text-white">{{$loop->index + 1}}</h5>
                        </td>
                        <td class="mx-auto px-4 py-5 border-b border-[#eee] dark:border-strokedark">
                            <div class="flex items-center mx-auto justify-center">
                                <a href="{{route('stok-bahan-baku-satuan.index', $item->id)}}" title="Show Detail Data" type="button"
                                    class="transition ease-in-out hover:bg-amber-50 focus:bg-amber-50 hover:text-amber-500 focus:text-amber-500 inline-flex w-fit rounded-l-md p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-amber-500 focus:ring-2 focus:ring-amber-500 sm:text-sm sm:leading-6">
                                    <svg class="w-5" viewBox="0 0 24 24" fill="currentColor" id="_003_ECOMMERCE_03" data-name="003_ECOMMERCE_03" xmlns="http://www.w3.org/2000/svg"  stroke="currentColor"><title>Update Stok</title>
                                        <path d="M20,21H4a.99974.99974,0,0,1-1-1V4A.99974.99974,0,0,1,4,3h9a1,1,0,0,1,0,2H5V19H19V5H17a1,1,0,0,1,0-2h3a.99974.99974,0,0,1,1,1V20A.99974.99974,0,0,1,20,21Z"/><polygon points="10 4 10 11 12 9 14 11 14 4 10 4" />
                                    </svg>
                                </a>
                                <button title="Edit Data" data-hs-overlay="#modal-edit-produk" type="button" id="edit-bahan-baku"
                                    data-id-bahan="{{$item->id}}"
                                    data-no-id-bahan="{{$item->id_no}}"
                                    data-nama-barang="{{$item->nama_barang}}"
                                    data-id-kategori-bahan="{{$item->id_kategori}}"
                                    data-id-warna="{{$item->warna->id}}"
                                    class="edit-bahan-baku transition ease-in-out border-l hover:bg-amber-50 focus:bg-amber-50 hover:text-amber-500 focus:text-amber-500 inline-flex w-fit p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-amber-500 focus:ring-2 focus:ring-amber-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button title="Hapus Data" data-hs-overlay="#modal-delete-produk" type="button" id="delete-bahan-baku"
                                    data-id-bahan="{{$item->id}}"
                                    data-no-id-bahan="{{$item->id_no}}"
                                    data-nama-barang="{{$item->nama_barang}}"
                                    data-id-kategori-bahan="{{$item->id_kategori}}"
                                    data-id-warna="{{$item->warna->id}}"
                                    class="delete-bahan-baku transition ease-in-out hover:bg-rose-50 border-l rounded-r-md focus:bg-rose-50 hover:text-rose-500 focus:text-rose-500 inline-flex w-fit  p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-rose-500 focus:ring-2 focus:ring-rose-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->id_no}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->nama_barang}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->warna->nama_warna}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->warna->kode_warna}}</p>
                        </td>
                        @foreach ($dateRange as $range)
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php
                                $stok = $item->stokHarian->firstWhere('tanggal', $range);
                                $stokMasuk = optional($stok)->stok_masuk ?? 0;
                                $stokKeluar = optional($stok)->stok_keluar ?? 0;
                                $satuanId = optional($stok)->id_satuan;
                                $satuanNama = optional($stok)->satuan->nama_satuan ?? '-';
    
                                if ($selectedUnit == '1' && $satuanId == '2') { // Yard to Meter
                                    $stokMasuk = round($stokMasuk / 1.09361, 2);
                                    $stokKeluar = round($stokKeluar / 1.09361, 2);
                                    $satuanNama = 'Meter';
                                } elseif ($selectedUnit == '2' && $satuanId == '1') { // Meter to Yard
                                    $stokMasuk = round($stokMasuk * 1.09361, 2);
                                    $stokKeluar = round($stokKeluar * 1.09361, 2);
                                    $satuanNama = 'Yard';
                                }
                            @endphp
                            <p class="text-black dark:text-white">
                                {{ $stokMasuk ?? '-' }} {{ $satuanNama ?? '-' }}
                            </p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <p class="text-black dark:text-white">
                                {{ $stokKeluar ?? '-' }} {{ $satuanNama ?? '-' }}
                            </p>
                        </td>
                    @endforeach
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ $totalStokMasuk[$item->id] ?? 0 }} {{$satuanNamaTotal}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ $totalStokKeluar[$item->id] ?? 0 }} {{$satuanNamaTotal}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ $totalStokMasuk[$item->id] - $totalStokKeluar[$item->id] }} {{$satuanNamaTotal}}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Harga Bahan Baku Satuan --}}
    @if ($loggedInUser->id_level_user == 1)
    <div class="max-w-full overflow-x-auto rounded-t-md mt-10">
        <h1 class="text-[40px] font-bold text-black sticky left-0 dark:text-white">Harga Kain</h1>        
        <table class="w-full table-auto mt-10">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th rowspan="3" class="min-w-[50px] text-center px-4 py-4 font-medium text-white dark:text-white sticky left-0 border-b bg-blue-600 border-white dark:bg-meta-4">
                        No
                    </th>
                    <th rowspan="3" class="text-center px-4 py-4 font-medium text-white dark:text-white">
                        NO ID
                    </th>
                    <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Nama Barang
                    </th>
                    <th rowspan="3" class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Warna
                    </th>
                    <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white">
                        Kode Warna
                    </th>
                    <th colspan="{{$jumlahHari}}" class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Tanggal
                    </th>
                </tr>
                <tr>
                    @foreach ($dateRange as $item)                        
                    <th colspan="1" class="text-center font-medium text-white dark:text-white border dark:bg-meta-4">
                        {{$item}}{{-- //tanggalnya --}}
                    </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($dateRange as $item)                        
                        <th class="px-2 whitespace-nowrap text-center font-medium bg-green-800 text-white dark:text-white border">
                            Harga Beli Satuan
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($data as $item)                    
                    <tr>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark sticky left-0 bg-blue-600 dark:bg-meta-4">
                            <h5 class="font-medium text-white dark:text-white">{{$loop->index + 1}}</h5>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->id_no}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->nama_barang}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->warna->nama_warna}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->warna->kode_warna}}</p>
                        </td>
                        @foreach ($dateRange as $range)
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php
                                $stok = $item->stokHarian->firstWhere('tanggal', $range);
                            @endphp
                            @if (optional($stok)->hargaProduk)                                
                                <p class="text-black dark:text-white">
                                    Rp. {{ number_format(optional($stok)->hargaProduk->harga_beli_satuan, 2, ',', '.') }}
                                </p>
                            @else
                            -
                            @endif
                        </td>
                    @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
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

    {{$data->links()}}
    @include('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.edit')
    @include('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.delete')
</div>