<div wire:ignore.self id="modal-show-invoice"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Lihat Resi
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-show-invoice" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Image preview -->
                <div>
                    <img id="imageShowInvoice" src="" alt="Bukti Foto" class="p-6" style="display: none; max-width: 100%; height: auto;">
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    // Ketika tombol edit diklik
    $('.show-invoice').click(function() {
    const id_invoice = $(this).data('id-invoice');
    const id_kontrak_rinci_for_invoice = $(this).data('id-kontrak-rinci');
    const foto_invoice = $(this).data('foto-invoice');
    
    // Mengatur nilai input ID pada form modal
    $('#id_kontrak_rinci_for_invoice').val(id_kontrak_rinci_for_invoice);
    $('#foto_invoice').val(foto_invoice);

    // Menampilkan gambar di modal
    const imageUrl = `upload/dokumen_invoice/${foto_invoice}`;
    $('#imageShowInvoice').attr('src', imageUrl).show();
});

</script>


    