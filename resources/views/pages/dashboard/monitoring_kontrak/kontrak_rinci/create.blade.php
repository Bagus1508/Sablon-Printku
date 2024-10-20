<div wire:ignore.self id="modal-create-kontrak-rinci"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Tambah Data Kontrak Rinci
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-create-kontrak-rinci" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('monitoring-kontrak-rinci.store')}}">
                    @csrf
                    <div class="p-6.5">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Kontrak (Takon) <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" id="takon" name="takon" placeholder="Masukan No Kontrak Takon"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <!-- <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Kontrak (HP) <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" id="no_telepon" name="no_telepon" placeholder="Masukan No Kontrak HP"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div> -->
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Kontrak Pihak Pertama <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" id="no_kontrak_pihak_pertama" name="no_kontrak_pihak_pertama" placeholder="Masukan No Kontrak Pihak Pertama"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Tanggal Kontrak <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="date" id="tanggal_kontrak" name="tanggal_kontrak" placeholder="Masukan Tanggal Kontrak"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Perusahaan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <select required name="id_perusahaan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                <option selected disabled>==Pilih Perusahaan==</option>
                                @foreach ($dataPerusahaan as $item)
                                <option value="{{$item->id}}">{{$item->nama_perusahaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Kontrak Rinci
                            </label>
                            <input type="text" id="no_kontrak_rinci" name="no_kontrak_rinci" placeholder="Masukan No Kontrak HP"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Tanggal Kontrak Rinci
                            </label>
                            <input type="date" id="tanggal_kr" name="tanggal_kr" placeholder="Masukan Tanggal Kontrak"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full underline">
                            Jangka Waktu Kontrak Rinci
                        </div>
                        <div class="mb-4.5 w-full flex justify-between">
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Awal Kontrak
                                </label>
                                <input type="date" id="awal_kr_create" name="awal_kr" placeholder="Masukan Nama Perusahaan" onchange="updateMasaKontrak()"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Akhir Kontrak  <span class="text-red-500 text-[10px]">*Otomatis Terisi</span>
                                </label>
                                <input type="date" readonly id="akhir_kr_create" name="akhir_kr" placeholder="Masukan Nama Perusahaan" onchange="updateMasaKontrak()"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Durasi Hari
                            </label>
                            <input onchange="updateAkhirKontrak()" type="text" id="durasi_hari_create" name="durasi_hari" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Masa Kontrak <span class="text-red-500 text-[10px]">*Otomatis Terisi</span>
                            </label>
                            <input readonly type="text" id="masa_kr_create" name="masa_kr" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Uraian
                            </label>
                            <textarea id="uraian" name="uraian" placeholder="Masukan Uraian"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
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
    function updateAkhirKontrak() {
        var awalKontrak = document.getElementById('awal_kr_create').value;
        var durasiHari = document.getElementById('durasi_hari_create').value;
        var akhirKontrakInput = document.getElementById('akhir_kr_create');
        var masaKontrakInput = document.getElementById('masa_kr_create');

        if (awalKontrak && durasiHari) {
            // Mengubah string tanggal menjadi objek Date
            var awalDate = new Date(awalKontrak);

            // Menambahkan durasi hari ke awal kontrak
            awalDate.setDate(awalDate.getDate() + parseInt(durasiHari));

            // Format tanggal hasil ke string dengan format yyyy-mm-dd
            var akhirKontrak = awalDate.toISOString().split('T')[0];

            // Menampilkan akhir kontrak dan masa kontrak
            akhirKontrakInput.value = akhirKontrak;
            masaKontrakInput.value = `${awalKontrak} - ${akhirKontrak}`;
        } else {
            akhirKontrakInput.value = '';
            masaKontrakInput.value = '';
        }
    }
</script>