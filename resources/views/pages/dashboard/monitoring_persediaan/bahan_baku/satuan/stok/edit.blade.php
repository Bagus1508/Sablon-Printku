<div wire:ignore.self id="modal-edit-stok-harian"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Data Kategori
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-stok-harian" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('stok-bahan-baku-satuan.update', (int)$ID)}}" id="form-edit-stok">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="p-6.5">
                        {{-- <input type="hidden" name="id_produk" value="{{$Id_produk}}"> --}}
                        <div class="flex gap-3 justify-between">
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    No ID
                                </label>
                                <input type="text" id="no_id" disabled placeholder="Masukan Nama Barang"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama Barang
                                </label>
                                <input type="text" id="nama_barang" disabled placeholder="Masukan Nama Barang"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Warna
                            </label>
                            <input type="text" id="warna" disabled placeholder="Masukan Nama Warna"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Tanggal <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="date" id="tanggal" name="tanggal" placeholder="Masukan Tanggal"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="flex gap-3 justify-between">
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Stok Masuk
                                </label>
                                <input type="number" id="stok_masuk" name="stok_masuk" placeholder="Masukan Stok Masuk"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Stok Keluar
                                </label>
                                <input type="number" id="stok_keluar" name="stok_keluar" placeholder="Masukan Stok Keluar"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Harga Beli Satuan
                            </label>
                            <input type="text" name="harga_beli_satuan" id="harga_beli_satuan" placeholder="Masukan Harga Beli Satuan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Satuan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required id="id_satuan" name="id_satuan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataSatuan as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_satuan }}
                                    </option>
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
    $('.edit-stok-harian').click(function() {
    const id = $(this).data('id-stok');
    const id_no = $(this).data('no-id');
    const nama_barang = $(this).data('nama-barang');
    const nama_warna = $(this).data('nama-warna');
    const kode_warna = $(this).data('kode-warna');
    const tanggal = $(this).data('tanggal');
    const stok_masuk = $(this).data('stok-masuk');
    const stok_keluar = $(this).data('stok-keluar');
    let harga_beli_satuan = $(this).data('harga-beli-satuan');
    const id_satuan = $(this).data('id-satuan');


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

    // Ubah harga_beli_satuan menjadi float
    harga_beli_satuan = parseFloat(harga_beli_satuan);
    if (!isNaN(harga_beli_satuan)) {
        // Jika harga_beli_satuan adalah angka yang valid
        harga_beli_satuan = harga_beli_satuan.toFixed(0);
    } else {
        // Jika tidak, berikan nilai default, misalnya 0.00
        harga_beli_satuan = "0.00";
    }

    // Mengatur nilai input ID pada form modal
    $('#no_id').val(id_no);
    $('#nama_barang').val(nama_barang);
    $('#warna').val(nama_warna + ' - ' + kode_warna);
    $('#tanggal').val(tanggal);
    $('#stok_masuk').val(stok_masuk);
    $('#stok_keluar').val(stok_keluar);
    $('#harga_beli_satuan').val(formatRupiah(harga_beli_satuan, 'Rp'));
    $('#id_satuan').val(id_satuan);

    // Select the form element
    const form = $('form');
    
    // Set the action attribute of the form
    const url = '{{ route("stok-bahan-baku-satuan.update", ":id") }}'.replace(':id', id);
    $('#form-edit-stok').attr('action', url);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target input dengan id "harga_beli_satuan"
        document.querySelectorAll('input[name="harga_beli_satuan"]').forEach(function(element) {
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