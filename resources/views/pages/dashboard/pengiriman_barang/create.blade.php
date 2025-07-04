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
            <x-input label="No Transaksi" name="no_transaksi" />
            <x-input label="Nama Pengaju" name="nama" />
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

