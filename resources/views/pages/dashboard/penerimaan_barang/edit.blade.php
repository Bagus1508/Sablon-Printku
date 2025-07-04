<x-app-layout>
    @section('title', 'Permintaan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Penerimaan Barang
            </h2>
        </div>
    </div>

    <div>
        <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
            Data Pengiriman Barang
        </div>
        <div id="generalForm" class="bg-white shadow-md rounded px-8 pt-6 grid grid-cols-4 gap-5 mx-5">
            <x-input label="No Surat Jalan" name="no_transaksi" :value="@$data->no_surat_jalan" disabled />
            <x-input label="Nama Pengaju" name="nama" :value="@$data->permintaanBarang->nama" disabled />
            <x-input label="Catatan" name="catatan" :value="@$data->permintaanBarang->catatan" disabled />
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 gap-5 mx-5">
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
                    @foreach ($data->permintaanBarang->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->nama_barang }}</td>
                            <td class="border px-4 py-2">{{ $item->spesifikasi_barang }}</td>
                            <td class="border px-4 py-2">{{ $item->satuan }}</td>
                            <td class="border px-4 py-2">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-2">{{ $item->alasan_kebutuhan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
                Form Penerimaan
            </div>
            <form id="receiptItemForm" method="POST" action="{{ route('penerimaan-barang.store') }}"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-5 mx-5">
                @csrf
                <input type="hidden" value="{{ $data->permintaanBarang->id }}" name="id_permintaan_barang"
                    id="id_permintaan_barang" class="id_permintaan_barang">
                <input type="hidden" value="{{ $data->id }}" name="id_pengiriman_barang" id="id_pengiriman_barang"
                    class="id_pengiriman_barang">
                <x-input label="No Surat Jalan" name="no_transaksi" :value="getTransactionNoReceiptItem()" readonly />
                <x-input label="Diterima Oleh" name="nama_penerima" value="{{ auth()->user()->name }}" />
                <x-input-select name="status" label="Status Penerimaan" :selected="@$data->penerimaanBarang->status ?? 0" :selectData="getReceiptItemStatusList()" />

                <div class="mx-auto justify-end">

                </div>
                <div class="justify-end items-end flex">
                    <button type="submit" id="submitForm"
                        class="bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @include('pages.dashboard.permintaan_barang.items.create')
</x-app-layout>
