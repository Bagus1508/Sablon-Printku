<x-app-layout>
    @section('title', 'Data Pajak')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Data Pajak
            </h2>
        </div>
        <div>
            <section class="justify-end flex max-sm:flex-col-reverse max-sm:mb-5">
                @if (is_null($dataPajak))                    
                <div class="my-5">
                    <button data-hs-overlay="#modal-create-pajak" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah Merek</button>
                </div>
                @endif
            </section>
            <div class="max-w-full overflow-x-auto rounded-t-md">
                <table class="w-full table-auto">
                    <thead class="bg-blue-600 text-white">
                        <tr class="text-left dark:bg-meta-4">
                            <th class="min-w-[50px] text-center px-4 py-4 font-medium text-white dark:text-white">
                                No
                            </th>
                            <th class="text-center px-4 py-4 font-medium text-white dark:text-white">
                                Pajak Penerimaan Negara
                            </th>
                            <th class="text-center px-4 py-4 font-medium text-white dark:text-white">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-200 dark:bg-meta-4">
                        @foreach ($dataPajak as $item)                            
                        <tr>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <h5 class="font-medium text-black dark:text-white">{{$loop->index + 1}}</h5>
                            </td>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-black dark:text-white">{{$item->ppn}}%</p>
                            </td>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-blue-600 hover:underline dark:text-white">
                                    <button data-hs-overlay="#modal-edit-pajak" id="edit-pajak" 
                                    data-id-pajak="{{$item->id}}"
                                    data-ppn="{{$item->ppn}}"
                                    class="edit-pajak hover:underline">
                                        Edit
                                    </button>
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('pages.dashboard.data_master.data_pajak.edit')
        </div>
    </div>
    @include('pages.dashboard.data_master.data_pajak.create')
</x-app-layout>
