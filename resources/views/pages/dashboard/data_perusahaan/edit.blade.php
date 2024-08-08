<div wire:ignore.self id="modal-edit-perusahaan"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Data Perusahaan
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-perusahaan" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('data-perusahaan.update', (int)$ID)}}" id="form-edit-perusahaan">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="p-6.5">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Nama Perusahaan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Kode Perusahaan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" id="kode_perusahaan" name="kode_perusahaan" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                NPWP
                            </label>
                            <input type="text" id="npwp" name="npwp" placeholder="Masukan NPWP"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Telepon
                            </label>
                            <input type="number" id="no_telepon" name="no_telepon" placeholder="Masukan No Telepon"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Email
                            </label>
                            <input type="email" id="email" name="email" placeholder="Masukan Email Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Alamat Perusahaan
                            </label>
                            <textarea type="text" id="alamat" name="alamat" placeholder="Masukan Nama Alamat Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">{{$AlamatJalan}}</textarea>
                        </div>
                        <div>
                            <div class="mb-4.5 w-full">
                                <label for="provinsi" class="mb-3 block text-sm font-medium text-black dark:text-white">Provinsi</label>
                                <select id="id_provinsi" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required="" name="provinsi">
                                    <option selected>Pilih Provinsi</option>
                                </select>
                            </div>
                        
                            <div wire:loading wire:target='getRegencies' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data Kabupaten/Kota ...">
                            </div>
                            <div class="mb-4.5 w-full">
                                <label for="kota" class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
                                <select id="id_kota" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required="" name="kota">
                                    <option selected>Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                        
                            <div wire:loading wire:target='getDistricts' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data kecamatan ...">
                            </div>
                            <div wire:loading.remove wire:target='getDistricts' class="mb-4.5 w-full">
                                <label for="kecamatan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
                                <select id="id_kecamatan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required="" name="kecamatan">
                                    <option selected>Pilih Kecamatan</option>
                                </select>
                            </div>
                        
                            <div wire:loading wire:target='getVillages' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data Kelurahan/Desa ...">
                            </div>
                            <div wire:loading.remove wire:target='getVillages' class="mb-4.5 w-full">
                                <label for="kelurahan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
                                <select  wire:model="ID_kelurahan" id="id_kelurahan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"required="" name="kelurahan" id="kelurahan" class="input-form-edit">
                                    <option selected >Pilih Kelurahan/Desa</option>
                                    @if ($apiVillages != null)
                                    @foreach ($apiVillages as $data)
                                                <option value="{{ $data['id'] . '|' . $data['name'] }}">{{Str::title($data['name'])}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('id_kelurahan') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
                            </div>
                        </div>                        
                        <div class="mb-4.5 w-full flex gap-3 justify-between">
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    RT
                                </label>
                                <input type="number" id="rt" name="rt" placeholder="Masukan RT Perusahaan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    RW
                                </label>
                                <input type="number" id="rw" name="rw" placeholder="Masukan RT Perusahaan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
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
    $('.edit-perusahaan').click(function() {
    const id = $(this).data('id-perusahaan');
    const kode_perusahaan = $(this).data('kode-perusahaan');
    const nama_perusahaan = $(this).data('nama-perusahaan');
    const npwp = $(this).data('npwp');
    const no_telepon = $(this).data('no-telepon');
    const email = $(this).data('email');
    const alamat = $(this).data('alamat');
    const nama_provinsi = $(this).data('nama-provinsi');
    const nama_kota = $(this).data('nama-kota');
    const nama_kecamatan = $(this).data('nama-kecamatan');
    const nama_kelurahan = $(this).data('nama-kelurahan');
    const idProvinsiTerpilih = $(this).data('id-provinsi');
    const idKotaTerpilih = $(this).data('id-kota');
    const idKecamatanTerpilih = $(this).data('id-kecamatan');
    const idKelurahanTerpilih = $(this).data('id-kelurahan');
    const rt = $(this).data('rt');
    const rw = $(this).data('rw');

    console.log(idKecamatanTerpilih);

    // Load provinces data
    $.ajax({
        url: 'https://bagus1508.github.io/api-wilayah-indonesia/api/provinces.json',
        method: 'GET',
        success: function(data) {
            // Empty the select before appending new options
            $('#id_provinsi').empty();
            $('#id_provinsi').append('<option value="">Pilih Provinsi</option>');

            // Loop through the data and append each option to the select
            $.each(data, function(index, item) {
                // Check if this item should be selected
                const isSelected = item.id == idProvinsiTerpilih ? 'selected' : '';
                $('#id_provinsi').append('<option value="' + item.id + '|' + item.name + '" ' + isSelected + '>' + item.name + '</option>');
            });

            // Jika ada id_provinsi terpilih, fetch regencies
            if (idProvinsiTerpilih) {
                fetchRegencies(idProvinsiTerpilih);
            }
        },
        error: function(err) {
            console.error('Error fetching data:', err);
        }
    });

    // Load regencies data based on selected province
    function fetchRegencies(idProvinsi) {
        $.ajax({
            url: 'https://bagus1508.github.io/api-wilayah-indonesia/api/regencies/' + idProvinsi + '.json',
            method: 'GET',
            success: function(data) {
                // Empty the select before appending new options
                $('#id_kota').empty();
                $('#id_kota').append('<option value="">Pilih Kabupaten/Kota</option>');

                // Loop through the data and append each option to the select
                $.each(data, function(index, item) {
                    // Check if this item should be selected
                    const isSelected = item.id == idKotaTerpilih ? 'selected' : '';
                    $('#id_kota').append('<option value="' + item.id + '|' + item.name + '" ' + isSelected + '>' + item.name + '</option>');
                });

                // Jika ada id_kota terpilih, fetch regencies
                if (idKotaTerpilih) {
                    fetchDistricts(idKotaTerpilih);
                }
            },
            error: function(err) {
                console.error('Error fetching data:', err);
            }
        });
    }

    // Load regencies data based on selected province
    function fetchDistricts(idKota) {
        $.ajax({
            url: 'https://bagus1508.github.io/api-wilayah-indonesia/api/districts/' + idKota + '.json',
            method: 'GET',
            success: function(data) {
                // Empty the select before appending new options
                $('#id_kecamatan').empty();
                $('#id_kecamatan').append('<option value="">Pilih Kecamatan</option>');

                // Loop through the data and append each option to the select
                $.each(data, function(index, item) {
                    // Check if this item should be selected
                    const isSelected = item.id == idKecamatanTerpilih ? 'selected' : '';
                    $('#id_kecamatan').append('<option value="' + item.id + '|' + item.name + '" ' + isSelected + '>' + item.name + '</option>');
                });

                // Jika ada id_kota terpilih, fetch regencies
                if (idKecamatanTerpilih) {
                fetchVillages(idKecamatanTerpilih);
                }
            },
            error: function(err) {
                console.error('Error fetching data:', err);
            }
        });
    }

    function fetchVillages(idKecamatan) {
        $.ajax({
            url: 'https://bagus1508.github.io/api-wilayah-indonesia/api/villages/' + idKecamatan + '.json',
            method: 'GET',
            success: function(data) {
                // Empty the select before appending new options
                $('#id_kelurahan').empty();
                $('#id_kelurahan').append('<option value="">Pilih Kelurahan</option>');

                // Loop through the data and append each option to the select
                $.each(data, function(index, item) {
                    // Check if this item should be selected
                    const isSelected = item.id == idKelurahanTerpilih ? 'selected' : '';
                    $('#id_kelurahan').append('<option value="' + item.id + '|' + item.name + '" ' + isSelected + '>' + item.name + '</option>');
                });
            },
            error: function(err) {
                console.error('Error fetching data:', err);
            }
        });
    }

    // Add event listener for change event on the id_provinsi select
    $('#id_provinsi').on('change', function() {
        const selectedValue = $(this).val(); // Misalnya, "36|BANTEN"
        const [idProvinsi, namaProvinsi] = selectedValue.split('|'); // Pisahkan ID dan nama

        console.log('Selected ID Provinsi:', idProvinsi);
        console.log('Selected Nama Provinsi:', namaProvinsi);

        // Fetch regencies based on the selected province
        fetchRegencies(idProvinsi);
    });

    $('#id_kota').on('change', function() {
        const selectedValue = $(this).val(); // Misalnya, "101|Kota A"
        const [idKota, namaKota] = selectedValue.split('|'); // Pisahkan ID dan nama

        console.log('Selected ID Kota:', idKota);
        console.log('Selected Nama Kota:', namaKota);

        // Fetch districts based on the selected city
        fetchDistricts(idKota);
    });

    $('#id_kecamatan').on('change', function() {
        const selectedValue = $(this).val(); // Misalnya, "202|Kecamatan B"
        const [idKecamatan, namaKecamatan] = selectedValue.split('|'); // Pisahkan ID dan nama

        console.log('Selected ID Kecamatan:', idKecamatan);
        console.log('Selected Nama Kecamatan:', namaKecamatan);

        // Fetch villages based on the selected district
        fetchVillages(idKecamatan);
    });

    // Mengatur nilai input ID pada form modal
    $('#kode_perusahaan').val(kode_perusahaan);
    $('#nama_perusahaan').val(nama_perusahaan);
    $('#npwp').val(npwp);
    $('#no_telepon').val(no_telepon);
    $('#email').val(email);
    $('#alamat').val(alamat);
    $('#id_provinsi').val(id_provinsi + '|' + nama_provinsi);
    $('#id_kota').val(id_kota + '|' + nama_kota);
    $('#id_kecamatan').val(id_kecamatan + '|' + nama_kecamatan);
    $('#id_kelurahan').val(id_kelurahan + '|' + nama_kelurahan);
    $('#rt').val(rt);
    $('#rw').val(rw);

    // Select the form element
    const form = $('form');
    
    // Set the action attribute of the form
    const url = '{{ route("data-perusahaan.update", ":id") }}'.replace(':id', id);
    $('#form-edit-perusahaan').attr('action', url);
});

</script>

