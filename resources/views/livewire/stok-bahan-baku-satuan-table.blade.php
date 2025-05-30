<div>
    <section class="justify-between flex max-sm:flex-col-reverse max-sm:mb-5">
        @include('livewire.search-data')
        <div class="my-5">
            <button data-hs-overlay="#modal-create-stok" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah Data</button>
        </div>
    </section>
    <x-datepicker-range name="tanggal"/>
    <div class="max-w-full overflow-x-auto rounded-t-md mt-5">
        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th class="min-w-[50px] text-center px-4 py-4 font-medium text-white dark:text-white sticky left-0 border-b border-r bg-blue-600 border-white">
                        No
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Tanggal
                    </th>
                    <th class="text-center px-4 py-4 font-medium text-white border-r dark:text-white">
                        NO ID
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Nama Barang
                    </th>
                    <th class="px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Warna
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Kode Warna
                    </th>
                    @if ($loggedInUser->id_level_user == 1)   
                    <th class="min-w-[150px] whitespace-nowrap px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Harga Beli Satuan
                    </th>
                    <th class="min-w-[300px] whitespace-nowrap px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Total Harga Beli
                    </th>
                    @endif
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Stok Masuk
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Stok Keluar
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Sisa Stok
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Panjang Per Roll
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Total Roll Masuk
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Roll Terpakai
                    </th>
                    <th class="min-w-[150px] px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Sisa Roll
                    </th>
                    <th class="px-4 py-4 text-center font-medium text-white border-r dark:text-white">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($dataStok as $item)
                @php
                    $tanggal = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y');
                @endphp      
                    <tr>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark sticky left-0 bg-blue-600">
                            <h5 class="font-medium text-white dark:text-white">{{$loop->index + 1}}</h5>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white text-nowrap">{{$tanggal ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->produk->id_no ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->produk->nama_barang ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->produk->warna->nama_warna ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->produk->warna->kode_warna ?? ''}}</p>
                        </td>
                        @if ($loggedInUser->id_level_user == 1)   
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark whitespace-nowrap">
                            @if ($item->hargaProduk)
                            <p class="text-black dark:text-white">Rp. {{ number_format($item->hargaProduk->harga_beli_satuan, 2, ',', '.') }}</p>
                            @endif
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark whitespace-nowrap">
                            @if ($item->hargaProduk)
                            <p class="text-black dark:text-white">Rp. {{ number_format($item->hargaProduk->harga_beli_satuan * $item->stok_masuk, 2, ',', '.') }}</p>
                            @endif
                        </td>
                        @endif
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->stok_masuk ?? ''}} {{$item->satuan->nama_satuan ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->stok_keluar ?? ''}} {{$item->satuan->nama_satuan ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->stok_masuk - $item->stok_keluar ?? ''}} {{$item->satuan->nama_satuan ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{number_format($item->roll_length ?? '0', 0)}} {{$item->satuan->nama_satuan ?? ''}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->total_rolls ?? '0'}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$item->used_rolls ?? '0'}}</p>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{number_format($item->remaining_rolls ?? '0', 0)}}</p>
                        </td>
                        <td class="mx-auto px-4 py-5 border-b border-[#eee] dark:border-strokedark">
                            <div class="flex items-center mx-auto justify-center">
                                <button data-hs-overlay="#modal-edit-stok-harian" type="button" id="edit-stok-harian"
                                    data-id-stok = "{{$item->id ?? ''}}"
                                    data-no-id = "{{$item->produk->id_no ?? ''}}"
                                    data-nama-barang = "{{$item->produk->nama_barang ?? ''}}"
                                    data-nama-warna = "{{$item->produk->warna->nama_warna ?? ''}}"
                                    data-kode-warna = "{{$item->produk->warna->kode_warna ?? ''}}"
                                    data-tanggal= "{{$item->tanggal ?? ''}}"
                                    data-roll-length= "{{$item->roll_length ?? ''}}"
                                    data-stok-masuk = "{{$item->stok_masuk ?? ''}}"
                                    data-stok-keluar = "{{$item->stok_keluar ?? ''}}"
                                    data-harga-beli-satuan = "{{$item->hargaProduk->harga_beli_satuan ?? ''}}"
                                    data-id-satuan = "{{$item->satuan->id ?? ''}}"
                                    class="edit-stok-harian transition ease-in-out hover:bg-amber-50 focus:bg-amber-50 hover:text-amber-500 focus:text-amber-500 inline-flex w-fit rounded-l-md p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-amber-500 focus:ring-2 focus:ring-amber-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button data-hs-overlay="#modal-delete-stok-harian" type="button" id="delete-stok-harian"
                                    data-id-stok = {{$item->id}}
                                    class="delete-stok-harian transition ease-in-out hover:bg-rose-50 border-l rounded-r-md focus:bg-rose-50 hover:text-rose-500 focus:text-rose-500 inline-flex w-fit  p-2 text-gray-900 items-center hover:ring-1 ring-inset ring-gray-300 hover:ring-rose-500 focus:ring-2 focus:ring-rose-500 sm:text-sm sm:leading-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
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

    {{$dataStok->links()}}
    @include('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.stok.edit')
    @include('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.stok.delete')
</div>