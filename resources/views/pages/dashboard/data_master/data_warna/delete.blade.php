<div wire:ignore.self id="modal-delete-warna" class="hs-overlay hidden w-full h-full bg-black/80 fixed top-0 left-0 z-9999 overflow-x-hidden overflow-y-auto [--overlay-backdrop:static]">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="flex flex-col bg-white dark:bg-boxdark border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
        <div class="p-4 overflow-y-auto">
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-white">Apakah anda yakin untuk menghapus warna ini?</h3>
                <form class="formhapus-metode" method="POST" action="{{route('data-warna.destroy', (int)$ID)}}" id="form-delete-warna">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-hs-overlay="#modal-delete-warna" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yakin
                    </button>
                    <button data-hs-overlay="#modal-delete-warna" type="reset" class="text-gray-500 bg-white dark:bg-slate-800 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Batal</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    // Ketika tombol edit diklik
    $('.delete-warna').click(function() {
    const id = $(this).data('id-warna');

    console.log(id);

    // Select the form element
    const form = $('form');
    
    // Set the action attribute of the form
    const url = '{{ route("data-warna.destroy", ":id") }}'.replace(':id', id);
    $('#form-delete-warna').attr('action', url);
});

</script>