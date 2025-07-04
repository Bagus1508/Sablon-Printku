<x-app-layout>
    @section('title', 'Permintaan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Permintaan Barang
            </h2>
            <div class="my-5">
                <button button id="submitForm"
                    class="bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700">Simpan</button>
            </div>
        </div>
    </div>

    <div>
        <form id="generalForm" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-4 gap-5 mx-5">
            <x-input label="No Transaksi" name="no_transaksi" value="{{ getTransactionNoItemReq() }}" readonly/>
            <x-input label="Nama Pengaju" name="nama" value="{{ auth()->user()->name }}" />
            <x-input label="Catatan" name="catatan" />
            <x-input-select name="status" label="Status" :selected="@$data->status ?? 0" :selectData="getStatusList()"/>
        </form>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 gap-5 mx-5">
            <div class=" my-5">
                <button data-hs-overlay="#modal-create-akun"
                    class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah
                    Barang</button>
            </div>
            <table class="table-auto" id="tabelBarang">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-blue-500 text-white">Kode Barang</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Nama Barang</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Spesifikasi Barang</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Satuan</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Jumlah</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Alasan Kebutuhan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data akan ditambahkan di sini --}}
                </tbody>
            </table>
        </div>
    </div>

    @include('pages.dashboard.permintaan_barang.items.create')
</x-app-layout>

<script>
    $('#tambahBarang').on('click', function() {
        const kode = $('#kode_barang').val();
        const nama = $('#nama_barang').val();
        const spesifikasi = $('#spesifikasi_barang').val();
        const satuan = $('#satuan').val();
        const jumlah = $('#jumlah').val();
        const alasan = $('#alasan_kebutuhan').val();

        // Validasi sederhana
        if (!kode || !nama || !spesifikasi || !satuan || !jumlah || !alasan) {
            alert("Semua field harus diisi!");
            return;
        }

        const row = `
            <tr>
                <td class="border px-4 py-2">${kode}</td>
                <td class="border px-4 py-2">${nama}</td>
                <td class="border px-4 py-2">${spesifikasi}</td>
                <td class="border px-4 py-2">${satuan}</td>
                <td class="border px-4 py-2">${jumlah}</td>
                <td class="border px-4 py-2">${alasan}</td>
            </tr>
        `;

        $('#tabelBarang tbody').append(row);

        // Kosongkan input
        $('#formBarang')[0].reset();
    });
</script>


{{-- Submit Data --}}
<script>
    $('#submitForm').on('click', function (e) {
        e.preventDefault();

        // Ambil data dari form utama
        const formData = {
            _token: $('input[name="_token"]').val(),
            no_transaksi: $('input[name="no_transaksi"]').val(),
            nama: $('input[name="nama"]').val(),
            catatan: $('input[name="catatan"]').val(),
            status: $('select[name="status"]').val()
        };

        // Ambil data dari tabel barang
        let barangList = [];
        $('#tabelBarang tbody tr').each(function () {
            const row = $(this).find('td');
            barangList.push({
                kode_barang: row.eq(0).text(),
                nama_barang: row.eq(1).text(),
                spesifikasi_barang: row.eq(2).text(),
                satuan: row.eq(3).text(),
                jumlah: row.eq(4).text(),
                alasan_kebutuhan: row.eq(5).text(),
            });
        });

        // Gabungkan semua data
        const dataToSend = {
            ...formData,
            barang: barangList
        };

        // Kirim via AJAX
        $.ajax({
            url: '{{ route("permintaan-barang.store") }}', // ganti dengan route-mu
            type: 'POST',
            data: dataToSend,
            success: function (response) {
                alert('Data berhasil disimpan!');
                window.location.href = "{{ route('permintaan-barang.index') }}";
            },
            error: function (xhr) {
                alert('Gagal menyimpan data!');
                console.log(xhr.responseText);
            }
        });
    });
</script>

