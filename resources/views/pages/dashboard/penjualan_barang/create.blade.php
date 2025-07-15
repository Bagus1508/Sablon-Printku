<x-app-layout>
    @section('title', 'Penjualan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Penjualan Barang
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
            <x-input label="No Transaksi" name="no_transaksi" value="{{ getTransactionNoSales() }}" readonly/>
            <x-input label="Nama Pembeli" name="nama" value="" />
            <x-input label="Catatan" name="catatan" />
            <x-input label="Total Transaksi" name="total_transaksi" value="0" />
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
                        <th class="px-4 py-2 bg-blue-500 text-white">Harga</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Jumlah</th>
                        <th class="px-4 py-2 bg-blue-500 text-white">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data akan ditambahkan di sini --}}
                </tbody>
            </table>
        </div>
    </div>

    @include('pages.dashboard.penjualan_barang.items.create')
</x-app-layout>

<script>
    $('#tambahBarang').on('click', function() {
        const kode = $('#kode_barang').val();
        const nama = $('#nama_barang').val();
        const harga = $('#harga').val();
        const jumlah = $('#jumlah').val();
        const subtotal = $('#sub_total').val();

        // Validasi sederhana
        if (!kode || !nama || !harga || !jumlah || !subtotal) {
            alert("Semua field harus diisi!");
            return;
        }

        const total_transaksi = $('#total_transaksi');
        const total_transaksi_val = total_transaksi.val() ?? 0;

        //Assign total transaksi
        total_transaksi.val(parseFloat(total_transaksi_val) + parseFloat(subtotal));

        const row = `
            <tr>
                <td class="border px-4 py-2">${kode}</td>
                <td class="border px-4 py-2">${nama}</td>
                <td class="border px-4 py-2">${harga}</td>
                <td class="border px-4 py-2">${jumlah}</td>
                <td class="border px-4 py-2">${subtotal}</td>
            </tr>
        `;

        $('#tabelBarang tbody').append(row);

        // Kosongkan input
        $('#formBarang')[0].reset();
        $('button[data-hs-overlay="#modal-create-akun"]').click();
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
            status: $('select[name="status"]').val(),
            total_transaksi: $('input[name="total_transaksi"]').val(),
        };

        // Ambil data dari tabel barang
        let barangList = [];
        $('#tabelBarang tbody tr').each(function () {
            const row = $(this).find('td');
            barangList.push({
                kode_barang: row.eq(0).text(),
                nama_barang: row.eq(1).text(),
                harga: row.eq(2).text(),
                jumlah: row.eq(3).text(),
                sub_total: row.eq(4).text(),
            });
        });

        // Gabungkan semua data
        const dataToSend = {
            ...formData,
            barang: barangList
        };

        // Kirim via AJAX
        $.ajax({
            url: '{{ route("penjualan-barang.store") }}', // ganti dengan route-mu
            type: 'POST',
            data: dataToSend,
            success: function (response) {
                alert('Data berhasil disimpan!');
                window.location.href = "{{ route('penjualan-barang.index') }}";
            },
            error: function (xhr) {
                alert('Gagal menyimpan data!');
                console.log(xhr.responseText);
            }
        });
    });
</script>

