<div wire:ignore.self id="modal-edit-ba-rikmatek"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit BA RIKMATEK
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-ba-rikmatek" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('ba-rikmatek.store')}}" id="form-proses-cutting">
                    @csrf
                    <div class="px-6.5 pb-6.5">
                        <input type="text" hidden name="id_kontrak_rinci" id="id_kontrak_rinci_ba_rikmatek">
                        <input type="text" hidden name="id" id="id_ba_rikmatek">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No
                            </label>
                            <input type="text" id="no_ba_rikmatek" name="no" placeholder="Masukan No"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Tanggal BA RIKMATEK
                            </label>
                            <input type="date" id="tanggal_ba_rikmatek" name="tanggal_ba_rikmatek" placeholder="Masukan Tanggal BA RIKMATEK"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                    </div>
                    <div class="bg-white dark:bg-boxdark flex justify-center">
                        <button type="submit" class="flex justify-center rounded w-full m-4 -mt-4 bg-primary font-medium p-2 text-gray hover:bg-opacity-90">
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
    $('.proses-ba-rikmatek').click(function() {
    const id_kontrak_rinci = $(this).data('id-kontrak-rinci');
    const id_ba_rikmatek = $(this).data('id-ba-rikmatek');
    const no_ba_rikmatek = $(this).data('no-ba-rikmatek');
    const tanggal_ba_rikmatek = $(this).data('tanggal-ba-rikmatek');
    
    // Mengatur nilai input ID pada form modal
    $('#id_kontrak_rinci_ba_rikmatek').val(id_kontrak_rinci);
    $('#id_ba_rikmatek').val(id_ba_rikmatek);
    $('#no_ba_rikmatek').val(no_ba_rikmatek);
    $('#tanggal_ba_rikmatek').val(tanggal_ba_rikmatek);

});
</script>