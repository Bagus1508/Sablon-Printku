<div wire:ignore.self id="modal-edit-total-harga"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Total Harga Kontrak
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-total-harga" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('monitoring-kontrak-rinci.updateTotalHarga', (int)$ID)}}" id="form-edit-total-harga">
                    @csrf
                    <div class="p-6.5">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Total Harga
                            </label>
                            <input type="text" id="total_harga_kontrak" name="total_harga" placeholder="Masukan Total Harga"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                PPN <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required name="id_pajak" id="id_pajak" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataPajak as $item)
                                <option value="{{$item->id}}">{{$item->ppn}}</option>
                                @endforeach
                            </select>
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
    $('.edit-total-harga').click(function() {
    const id = $(this).data('id');
    let total_harga_kontrak = $(this).data('total-harga-kontrak');
    const id_pajak = $(this).data('id-pajak');
    
    function formatRupiah(angka, prefix) {
        var numberString = angka.toString(),
            split = numberString.split('.'),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + ' ' + rupiah : '');
    }

    // Ubah total_harga_kontrak menjadi float
    total_harga = parseFloat(total_harga_kontrak);
    if (!isNaN(total_harga)) {
        // Jika total_harga_kontrak adalah angka yang valid
        total_harga = total_harga_kontrak.toFixed(0);
    } else {
        // Jika tidak, berikan nilai default, misalnya 0.00
        total_harga = "0.00";
    }
    
    // Mengatur nilai input ID pada form modal
    $('#total_harga_kontrak').val(formatRupiah(total_harga, 'Rp'));
    $('#id_pajak').val(id_pajak);

    // Select the form element
    const form = $('form');
    
    // Set the action attribute of the form
    const url = '{{ route("monitoring-kontrak-rinci.updateTotalHarga", ":id") }}'.replace(':id', id);
    $('#form-edit-total-harga').attr('action', url);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target input dengan id "total_harga_kontrak"
        document.querySelectorAll('[id="total_harga_kontrak"]').forEach(function(element) {
            element.addEventListener('keyup', function(e) {
                // Ambil value dari input
                var angka = this.value.replace(/[^,\d]/g, '').toString();
                // Panggil fungsi untuk memformat ke dalam format Rupiah
                this.value = formatRupiah(angka, 'Rp. ');
            });
        });
    
        function formatRupiah(angka, prefix) {
            var numberString = angka.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
    
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }
    });
</script>