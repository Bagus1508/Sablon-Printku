<div wire:ignore.self id="modal-edit-produk"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Data Bahan
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-produk" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('persediaan-bahan-baku-satuan.update', (int)$ID)}}" id="form-edit-bahan-baku">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="p-6.5">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                NO ID Bahan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input required type="text" id="no_id" name="id_no" placeholder="Masukan NO ID Bahan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Kategori <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required id="id_kategori" name="id_kategori" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataKategori as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Nama Barang <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input required type="text" id="nama_barang" name="nama_barang" placeholder="Masukan Nama Barang"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Warna <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required id="id_warna" name="id_warna" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataWarna as $item)
                                <option value="{{$item->id}}">{{$item->nama_warna}} ({{$item->kode_warna}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-boxdark flex justify-center">
                        <button class="flex justify-center rounded w-full m-4 -mt-4 bg-primary font-medium p-2 text-gray hover:bg-opacity-90">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Ketika tombol edit diklik
    $('.edit-bahan-baku').click(function() {
        const id = $(this).data('id-bahan');
        const no_id = $(this).data('no-id-bahan');
        const nama_barang = $(this).data('nama-barang');
        const id_kategori = $(this).data('id-kategori-bahan');
        const id_warna = $(this).data('id-warna');

        // Mengatur nilai input ID pada form modal
        $('#no_id').val(no_id);
        $('#nama_barang').val(nama_barang);
        $('#id_kategori').val(id_kategori);
        $('#id_warna').val(id_warna);

        // Select the form element
        const form = $('form');
        
        // Set the action attribute of the form
        const url = '{{ route("persediaan-bahan-baku-satuan.update", ":id") }}'.replace(':id', id);
        $('#form-edit-bahan-baku').attr('action', url);
    });

</script>
