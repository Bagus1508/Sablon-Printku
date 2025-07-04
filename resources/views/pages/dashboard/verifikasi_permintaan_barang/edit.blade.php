<x-app-layout>
    @section('title', 'Permintaan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Verifikasi Permintaan Barang
            </h2>
        </div>
    </div>

    @include('pages.dashboard.monitoring_kontrak.kontrak_rinci.status_kontrak.pengiriman_barang.edit')


    <div>
        <form id="verificationForm" action="{{ route('verifikasi-permintaan-barang.store') }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-3 gap-5 mx-5">
            @csrf
            <input type="hidden" id="id_permintaan_barang" name="id_permintaan_barang" value="{{@$data->id}}">
            <x-input label="No Transaksi" name="no_transaksi" readonly value="{{ getTransactionNoVerificationPr() }}" />
            <x-input label="Disetujui Oleh" name="nama_verifikator" value="{{ auth()->user()->name }}" />
            <x-input-select name="status" label="Status Verifikasi" :selected="@$data->status ?? 0" :selectData="getStatusList()" />

            <div class="mx-auto justify-end">

            </div>
            <div class="mx-auto justify-end">

            </div>
            <div class="justify-end items-end flex">
                <button button id="submitForm"
                    class="bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700">Simpan</button>
            </div>
        </form>
        <div id="generalForm"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-4 gap-5 mx-5">
            <x-input label="No Transaksi" name="no_transaksi" :value="@$data->no_transaksi" disabled />
            <x-input label="Nama Pengaju" name="nama" :value="@$data->nama" disabled />
            <x-input label="Catatan" name="catatan" :value="@$data->catatan" disabled />
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
                    @foreach ($data->items as $item)
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
    </div>

    @include('pages.dashboard.permintaan_barang.items.create')
</x-app-layout>
