<div>
    <div class="my-5">
        <form action="{{route('preview-export-stok-global')}}" method="GET" class="flex mt-3 gap-x-3 max-sm:flex-col gap-5">
            <x-datepicker-range name="tanggal"/>
            <button type="submit" class="transition ease-in-out hover:bg-gray-100 hover:text-gray-950 inline-flex w-fit rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 justify-center my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-1 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Preview
            </button>
            <div class="mb-4">
                <label for="unit" class="block text-sm font-medium text-gray-700">Pilih Satuan</label>
                <select wire:model.lazy='selectedUnit' id="unit" name="id_satuan" class="dark:bg-boxdark ring-1 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm rounded-md">
                    <option selected value="1">Meter</option>
                    <option value="2">Yard</option>
                </select>
            </div>
        </form>
    </div>        
    <section class="justify-between flex max-sm:flex-col-reverse max-sm:mb-5 mb-5 max-sm:gap-5">
        @include('livewire.search-data')
    </section>
    <div class="max-w-full overflow-x-auto rounded-t-md">
        <table class="w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr class="text-left dark:bg-meta-4">
                    <th class="min-w-[50px] text-center px-4 py-4 font-medium text-white dark:text-white">
                        No
                    </th>
                    <th class="text-center px-4 py-4 font-medium text-white dark:text-white">
                        NO ID
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Nama Barang
                    </th>
                    <th class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Warna
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Kode Warna
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Total Panjang
                    </th>
                    <th class="px-4 py-4 text-center font-medium text-white dark:text-white">
                        Satuan
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Total Roll Masuk
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Roll Terpakai
                    </th>
                    <th class="px-4 py-4 text-center whitespace-nowrap font-medium text-white dark:text-white">
                        Sisa Roll
                    </th>
                </tr>
            </thead>
            <tbody class="dark:bg-meta-4">
                @foreach ($data as $item)
                <tr>
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <h5 class="font-medium text-black dark:text-white">{{$loop->index + 1}}</h5>
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
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{$item->totalStokAwal}}</p>
                    </td>               
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{$item->satuanNamaTotal}}</p>
                    </td>                    
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{$item->total_rolls}}</p>
                    </td>                    
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{$item->used_rolls}}</p>
                    </td>                    
                    <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{$item->total_rolls - $item->used_rolls}}</p>
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

    {{$data->links()}}
</div>