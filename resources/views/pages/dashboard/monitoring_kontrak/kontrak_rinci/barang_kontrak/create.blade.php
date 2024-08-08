<div wire:ignore.self id="modal-tambah-barang"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Tambah Barang Kontrak
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-tambah-barang" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('barang-kontrak-rinci.store')}}" id="form-barang-kontrak">
                    @csrf
                    <input type="text" hidden name="id_kontrak_rinci" class="id_kontrak_rinci">
                    <div id="inputContainer" class="p-6.5">
                        <div id="input-container">
                            <!-- Input default pertama -->
                            <div id="input-template" class="input-group mb-4">
                                <div class="mb-4 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Nama Barang <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                                    </label>
                                    <select required name="id_produk[]" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                        @foreach ($dataProdukPakaian as $item)
                                        <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-between gap-3">
                                    <div class="mb-4 w-full">
                                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                            Kuantitas
                                        </label>
                                        <input type="number" name="kuantitas[]" placeholder="Masukan Kuantitas"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                    </div>
                                    <div class="mb-4 w-full">
                                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                            Satuan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                                        </label>
                                        <select required name="id_satuan[]" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                            @foreach ($dataSatuan as $item)
                                            <option value="{{$item->id}}">{{$item->nama_satuan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Volume Kontrak
                                    </label>
                                    <input type="number" name="volume_kontrak[]" placeholder="Masukan Volume Kontrak"
                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                </div>
                                <div class="mb-4 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Volume Realisasi
                                    </label>
                                    <input type="number" name="volume_realisasi[]" placeholder="Masukan Volume Realisasi"
                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                </div>
                                <div class="mb-4 w-full">
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Volume Sisa
                                    </label>
                                    <input type="number" name="volume_sisa[]" placeholder="Masukan Volume Sisa"
                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                </div>
                                <!-- Tombol hapus untuk setiap input -->
                                <button type="button" class="remove-input btn btn-primary px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-600">Hapus</button>
                            </div>
                        </div>
                        <button type="button" id="add-input" class="btn btn-primary px-6 py-3 bg-blue-600 text-white rounded-md mb-4 hover:bg-blue-700">Tambah Input</button>
                    
                        {{-- <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Total Harga
                            </label>
                            <input type="text" name="total_harga" id="total_harga" placeholder="Masukan Harga"
                                class="total-harga w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>       --}}                  
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
    $(document).on('click', '.barang-kontrak', function() {
        const id = $(this).data('id-kontrak-rinci');

        console.log(id);
        
        // Mengatur nilai input ID pada form modal
        $('.id_kontrak_rinci').val(id);
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let inputContainer = document.getElementById('input-container');
        let addButton = document.getElementById('add-input');
        let inputTemplate = document.getElementById('input-template').innerHTML;
        let inputCount = inputContainer.children.length; // Menghitung input yang sudah ada
    
        addButton.addEventListener('click', function() {
            inputCount++;
            let newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-4');
            newInput.innerHTML = inputTemplate;
            inputContainer.appendChild(newInput);
    
            // Tampilkan tombol hapus setelah input kedua
            if (inputCount > 1) {
                document.querySelectorAll('.remove-input').forEach(btn => btn.style.display = 'inline-block');
            }
        });
    
        // Delegate click event to dynamically added remove buttons
        inputContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-input')) {
                e.target.parentElement.remove();
                inputCount--;
    
                // Sembunyikan tombol hapus jika hanya ada satu input tersisa
                if (inputCount <= 1) {
                    document.querySelectorAll('.remove-input').forEach(btn => btn.style.display = 'none');
                }
            }
        });
    
        // Inisialisasi visibilitas tombol hapus
        if (inputCount <= 1) {
            document.querySelectorAll('.remove-input').forEach(btn => btn.style.display = 'none');
        }
    });
</script>    
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target input dengan id "harga_barang"
        document.querySelectorAll('input[name="total_harga"]').forEach(function(element) {
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
</script> --}}

    