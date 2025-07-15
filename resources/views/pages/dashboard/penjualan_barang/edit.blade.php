<x-app-layout>
    @section('title', 'Penjualan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Edit Penjualan Barang
            </h2>
            <div class="flex gap-2">
                <div class="">
                    <button id="printButton"
                        class="bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700"
                        data-print-url="{{ route('penjualan-barang.print', $data->id) }}">
                        Print
                    </button>
                </div>
                <div class="">
                    <button button id="submitForm"
                        class="bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <form id="generalForm" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-4 gap-5 mx-5">
            <x-input label="No Transaksi" name="no_transaksi" :value="@$data->no_transaksi" />
            <x-input label="Nama Pengaju" name="nama" :value="@$data->nama" />
            <x-input label="Catatan" name="catatan" :value="@$data->catatan" />
            <x-input-select name="status" label="Status" :selected="@$data->status ?? 0" :selectData="getStatusList()" />
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
                    @foreach ($data->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->kode_barang }}</td>
                            <td class="border px-4 py-2">{{ $item->nama_barang }}</td>
                            <td class="border px-4 py-2">{{ $item->harga }}</td>
                            <td class="border px-4 py-2">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-2">{{ $item->sub_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('pages.dashboard.permintaan_barang.items.create')
</x-app-layout>

<script>
    $('#tambahBarang').on('click', function() {
        const nama = $('#nama_barang').val();
        const spesifikasi = $('#spesifikasi_barang').val();
        const satuan = $('#satuan').val();
        const jumlah = $('#jumlah').val();
        const alasan = $('#alasan_kebutuhan').val();

        // Validasi sederhana
        if (!nama || !spesifikasi || !satuan || !jumlah || !alasan) {
            alert("Semua field harus diisi!");
            return;
        }

        const row = `
            <tr>
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
    $('#submitForm').on('click', function(e) {
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
        $('#tabelBarang tbody tr').each(function() {
            const row = $(this).find('td');
            barangList.push({
                nama_barang: row.eq(0).text(),
                spesifikasi_barang: row.eq(1).text(),
                satuan: row.eq(2).text(),
                jumlah: row.eq(3).text(),
                alasan_kebutuhan: row.eq(4).text(),
            });
        });

        // Gabungkan semua data
        const dataToSend = {
            ...formData,
            barang: barangList
        };

        // Kirim via AJAX
        $.ajax({
            url: '{{ route('permintaan-barang.update', 1) }}', // ganti dengan route-mu
            type: 'POST',
            data: dataToSend,
            success: function(response) {
                alert('Data berhasil disimpan!');
                window.location.href = "{{ route('permintaan-barang.index') }}";
            },
            error: function(xhr) {
                alert('Gagal menyimpan data!');
                console.log(xhr.responseText);
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil tombol berdasarkan ID
        const printButton = document.getElementById('printButton');

        if (printButton) {
            printButton.addEventListener('click', function() {
                // Ambil URL dari atribut data
                const printUrl = this.dataset.printUrl;

                if (printUrl) {
                    window.open(printUrl, '_blank'); // Buka di tab baru
                    // Atau jika tidak perlu tab baru:
                    // window.location.href = printUrl;
                }
            });
        }
    });
</script>
