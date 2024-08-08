<div wire:ignore.self id="modal-create-stok"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Tambah Stok  Stok Pakaian dan Celana
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-create-stok" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('stok-pakaian-celana-satuan.store')}}">
                    @csrf
                    <div class="p-6.5">
                        <div class="flex gap-3 justify-between">
                            {{-- Id Produk --}}
                            <input type="hidden" name="id_produk" value="{{$dataStokBahan->id ?? ''}}">
                            {{-- Id Produk --}}
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    No ID
                                </label>
                                <input type="text" disabled placeholder="Masukan Nama Barang" value="{{$dataStokBahan->id_no ?? ''}}"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama Barang
                                </label>
                                <input type="text" disabled placeholder="Masukan Nama Barang" value="{{$dataStokBahan->nama_barang ?? ''}}"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Warna
                            </label>
                            <input type="text" disabled placeholder="Masukan Nama Barang" value="{{$dataStokBahan->warna->nama_warna ?? ''}} - {{$dataStokBahan->warna->kode_warna ?? ''}}"
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
                                <input type="number" name="stok_masuk" placeholder="Masukan Stok Masuk"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Stok Keluar
                                </label>
                                <input type="number" name="stok_keluar" placeholder="Masukan Stok Keluar"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Ukuran <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required id="id_ukuran" name="id_ukuran" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataUkuran as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_ukuran }}
                                    </option>
                                @endforeach
                            </select>                            
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Satuan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required id="id_satuan" name="id_satuan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                @foreach ($dataSatuan as $item)
                                <option value="{{$item->id}}">{{$item->nama_satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($loggedInUser->id_level_user == 1)                            
                        {{-- Harga Produksi Satuan --}}
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Harga Produksi Satuan
                            </label>
                            <input type="text" name="harga_produksi_satuan" id="harga_produksi_satuan" placeholder="Masukan Harga Beli Satuan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        {{-- Harga Jual Satuan --}}
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Harga Jual Satuan
                            </label>
                            <input type="text" name="harga_jual_satuan" id="harga_jual_satuan" placeholder="Masukan Harga Beli Satuan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        @endif
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
    document.addEventListener('DOMContentLoaded', function() {
        // Target input dengan id "harga_beli_satuan"
        document.querySelectorAll('input[name="harga_produksi_satuan"], input[name="harga_jual_satuan"]').forEach(function(element) {
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