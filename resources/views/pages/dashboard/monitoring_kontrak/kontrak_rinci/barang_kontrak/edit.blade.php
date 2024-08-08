<div wire:ignore.self id="modal-edit-barang"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Barang
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-barang" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('monitoring-kontrak-rinci.updateBarang', (int)$ID)}}" id="form-edit-barang-kontrak">
                    @csrf
                    <div id="inputContainer" class="p-6.5">
                        <!-- Input default pertama -->
                        <div class="input-group mb-4.5">
                            <input type="text" hidden name="id_barang_kontrak" id="id_barang_kontrak" class="id_barang_kontrak">
                            <div class="mb-4 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama Barang <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                                </label>
                                <select required name="id_produk" id="id_produk" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                    @foreach ($dataProdukPakaian as $item)
                                    <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-between gap-3">
                                <div class="mb-4.5 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Kuantitas
                                    </label>
                                    <input type="number" name="kuantitas" id="kuantitas" placeholder="Masukan Kuantitas"
                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                </div>
                                <div class="mb-4.5 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Satuan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                                    </label>
                                    <select required name="id_satuan" id="id_satuan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                        @foreach ($dataSatuan as $item)
                                        <option value="{{$item->id}}">{{$item->nama_satuan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Volume Kontrak
                                </label>
                                <input type="number" name="volume_kontrak" id="volume_kontrak" placeholder="Masukan Volume Kontrak"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Volume Realisasi
                                </label>
                                <input type="number" name="volume_realisasi" id="volume_realisasi" placeholder="Masukan Volume Realisasi"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Volume Sisa
                                </label>
                                <input type="number" name="volume_sisa" id="volume_sisa" placeholder="Masukan Volume Sisa"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            @if ($loggedInUser->id_level_user == 1)                                
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Harga
                                </label>
                                <input type="text" name="harga_barang" id="harga_barang_kontrak" placeholder="Masukan Harga Barang"
                                    class="harga-barang w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white dark:bg-boxdark flex justify-center">
                        <button type="submit" class="flex justify-center rounded w-full m-4 bg-primary font-medium p-2 text-gray hover:bg-opacity-90">
                            Submit
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Gunakan event delegation untuk elemen yang di-generate secara dinamis
    $(document).on('click', '.edit-barang-kontrak', function() {
        const id = $(this).data('id');
        const id_produk = $(this).data('id-barang-kontrak');
        const kuantitas = $(this).data('kuantitas-barang-kontrak');
        const id_satuan = $(this).data('id-satuan-kontrak');
        const volume_kontrak = $(this).data('volume-kontrak');
        const volume_realisasi = $(this).data('volume-realisasi-kontrak');
        const volume_sisa = $(this).data('volume-sisa-kontrak');
        const harga_barang_kontrak = parseFloat($(this).data('harga-barang-kontrak'));

        // Fungsi untuk memformat angka ke format Rupiah
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

        // Mengatur nilai input ID pada form modal
        $('#id_barang_kontrak').val(id);
        $('#id_produk').val(id_produk);
        $('#kuantitas').val(kuantitas);
        $('#id_satuan').val(id_satuan);
        $('#volume_kontrak').val(volume_kontrak);
        $('#volume_realisasi').val(volume_realisasi);
        $('#volume_sisa').val(volume_sisa);
        $('#harga_barang_kontrak').val(formatRupiah(harga_barang_kontrak.toFixed(2), 'Rp'));

        // Select the form element
        const form = $('form');

        // Set the action attribute of the form
        const url = '{{ route("monitoring-kontrak-rinci.updateBarang", ":id") }}'.replace(':id', id);
        $('#form-edit-barang-kontrak').attr('action', url);
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var hargaInput = document.getElementById('harga_barang_kontrak');

        hargaInput.addEventListener('keyup', function(e) {
            var angka = hargaInput.value.replace(/[^,\d]/g, '');
            hargaInput.value = formatRupiah(angka, 'Rp. ');
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

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }
    });
</script>

    