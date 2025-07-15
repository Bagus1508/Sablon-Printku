<div wire:ignore.self id="modal-create-akun"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Tambah Barang
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-create-akun" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:dark:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form id="formBarang" method="POST">
                    @csrf
                    <div class="py-6.5 px-5">
                        <x-input-select id="kode_barang" name="kode_barang" label="Kode Barang" :selected="@$data->kode_barang ?? 0" :selectData="@$dataProduk"/>
                        <x-input label="Nama Barang" name="nama_barang" id="nama_barang" readonly/>
                        <x-input label="Harga" name="Harga" id="harga" type="number" readonly/>
                        <x-input label="Jumlah" name="jumlah" id="jumlah" type="number"/>
                        <x-input label="Sub Total" name="sub_total" id="sub_total" type="number" readonly/>
                    </div>

                    <div class="bg-white dark:bg-boxdark flex justify-center">
                        <button type="button" id="tambahBarang"
                            class="flex justify-center rounded w-full m-4 -mt-4 bg-primary font-medium p-2 text-gray hover:bg-opacity-90">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const getListProduct = @json(getListProduct());
    const getPriceProduct = @json(getPriceProduct());

    
    $('#kode_barang').on('change', function () {
        const kode = $(this).val();
        const name = getListProduct[kode];
        const price = getPriceProduct[kode];
        
        $('#nama_barang').val(name);
        $('#harga').val(price);
        $('#jumlah').val(1);
        $('#sub_total').val(price * 1);
    })
    
    $('#jumlah').on('input', function () {
        const priceInput = $('#harga').val();
        const quantity = $(this).val();
        
        $('#sub_total').val(priceInput * quantity);
    });
</script>