<x-app-layout>
    @section('title', 'Permintaan Barang')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Pengiriman Barang
            </h2>
        </div>
    </div>

    <div>
        {{-- Detail Barang --}}
        <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
            Data Permintaan Barang
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-1 gap-5 mx-5">
            <form id="generalForm" method="POST" class="grid grid-cols-3 gap-5">
                <x-input label="No Transaksi" name="no_transaksi" :value="@$data->no_transaksi" disabled />
                <x-input label="No Transaksi Verifikasi" name="no_transaksi_verifikasi" :value="@$dataVerifikasi->no_transaksi" disabled />
                <x-input label="Nama Pengaju" name="nama" :value="@$data->nama" disabled />
                <x-input label="Catatan" name="catatan" :value="@$data->catatan" disabled />
                
                @if ($dataPengiriman)
                    @if ($dataPengiriman->status === 0)
                        <x-input classInput="text-red-500" label="Status Pengiriman" name="status" :value="getDeliveryStatusList($dataPengiriman->status)" disabled />
                    @elseif ($dataPengiriman->status === 1)
                        <x-input classInput="text-yellow-500" label="Status Pengiriman" name="status" :value="getDeliveryStatusList($dataPengiriman->status)" disabled />
                    @else
                        <x-input classInput="text-green-500" label="Status Pengiriman" name="status" :value="getDeliveryStatusList($dataPengiriman->status)" disabled />
                    @endif
                @endif
            </form>
            <div class="">
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

        <div class="font-bold text-lg text-white bg-blue-500 shadow-md rounded px-8 py-2 mx-5 border-y-1">
            Form Pengiriman
        </div>
        <div id="verificationForm" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 gap-5 mx-5">
            <div class="">
                <div class="rounded-md ">
                    <form method="POST" action="{{ route('pengiriman-barang.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-3 gap-3">
                            <input type="text" hidden value="{{ $data->id }}" name="id_permintaan_barang"
                                id="id_permintaan_barang" class="id_permintaan_barang">
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Region
                                </label>
                                <select required name="id_region" id="region_pengiriman"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                    @foreach ($dataRegion as $item)
                                        <option value="{{ $item->id }}"
                                            @if (@$dataPengiriman->id_region == $item->id) selected @endif>{{ $item->nama_region }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    No Surat Jalan
                                </label>
                                <input type="integer" name="no_surat_jalan" id="no_surat_jalan" @if (@$dataPengiriman->no_surat_jalan)
                                    readonly
                                @endif
                                    value="{{ @$dataPengiriman->no_surat_jalan ?? getTransactionNoDelivery() }}" placeholder="Masukan No Surat Jalan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Tanggal
                                </label>
                                <input type="date" name="tanggal_surat_jalan" id="tanggal_surat_jalan"
                                    value="{{ @$dataPengiriman->tanggal_surat_jalan }}"
                                    placeholder="Masukan Tanggal Surat Jalan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Bukti Foto
                                </label>
                                <!-- Image preview -->
                                <div>
                                    <img id="imagePreview"
                                        src="{{ asset('storage/upload/dokumen_pengiriman_barang/' . @$dataPengiriman->bukti_foto) }}"
                                        alt="Bukti Foto" style="max-width: 100%; height: auto;">
                                </div>
                                <input type="file" name="bukti_foto" placeholder="Masukan Bukti Foto"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama Ekspedisi
                                </label>
                                <select required name="id_ekspedisi" id="ekspedisi_pengiriman"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                                    @foreach ($dataEkspedisi as $item)
                                        <option value="{{ $item->id }}"
                                            @if (@$dataPengiriman->id_ekspedisi == $item->id) selected @endif>
                                            {{ $item->nama_ekspedisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="justify-end items-end flex">
                            <button type="submit" id="submitForm"
                                class="bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @include('pages.dashboard.permintaan_barang.items.create')
</x-app-layout>
