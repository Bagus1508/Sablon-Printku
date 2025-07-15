<x-app-layout>
    @section('title', 'Serah Terima Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Serah Terima Barang
            </h2>
        </div>
    </div>

    <div>
        <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
            Data Penjualan Barang
        </div>
        <div id="generalForm" class="bg-white shadow-md rounded px-8 pt-6 grid grid-cols-4 gap-5 mx-5">
            <x-input label="No Transaksi" name="no_transaksi" :value="@$data->no_transaksi" disabled />
            <x-input label="Nama Pembeli" name="nama" :value="@$data->nama" disabled />
            <x-input label="Total Transaksi" name="total_transaksi" :value="formatCurrency(@$data->total_transaksi)" disabled />
            <x-input label="Catatan" name="catatan" :value="@$data->catatan" disabled />
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 gap-5 mx-5">
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
                            <td class="border px-4 py-2">{{ formatCurrency($item->harga) }}</td>
                            <td class="border px-4 py-2">{{ formatCurrency($item->jumlah) }}</td>
                            <td class="border px-4 py-2">{{ formatCurrency($item->sub_total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
                Form Penerimaan
            </div>
            <form id="receiptItemForm" method="POST" action="{{ route('serah-terima-barang.store') }}"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-5 mx-5">
                @csrf
                <input type="hidden" value="{{ $data->id }}" name="id_penjualan_barang" id="id_penjualan_barang"
                    class="id_penjualan_barang">
                <x-input label="No Transaksi" name="no_transaksi" :value="getTransactionNoReceiptCustomer()" readonly />
                <x-input label="Diterima Oleh" name="nama_penerima" value="{{ @$data->penerimaanBarang->nama }}" />
                <x-input-select name="status" label="Status Penerimaan" :selected="@$data->penerimaanBarang->status ?? 0" :selectData="getReceiptItemStatusList()" />

                <div class="mx-auto justify-end">

                </div>

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
