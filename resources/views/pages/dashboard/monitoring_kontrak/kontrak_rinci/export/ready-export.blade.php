<table class="w-full table-auto">
    <thead>
        <tr class=" dark:bg-meta-4">
            <th rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                No
            </th>
            <th width="400px" colspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                No Kontrak
            </th>
            <th rowspan="2" width="200px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Kontrak
            </th>
            <th colspan="3" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Jangka Waktu Kontrak Rinci
            </th>
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Uraian
            </th>
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Item Barang
            </th>
            <th width="200px"  rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Qty
            </th>
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Satuan
            </th>
            @if ($loggedInUser->id_level_user == 1)                
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Harga
            </th>
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                PPN
            </th>
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Harga + PPN
            </th>
            @endif
            @if ($checkbox_cutting == 'true')         
            <th colspan="3" style="background-color: #EBD2DD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Proses Cutting
            </th>
            @endif
            @if ($checkbox_jahit == 'true')                
            <th colspan="3" style="background-color: #D4A6BD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Proses Jahit
            </th>
            @endif
            @if ($checkbox_packing == 'true')         
            <th colspan="3" style="background-color: #D9D3E9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Packing
            </th>
            @endif
            <th colspan="5" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Pengiriman Barang
            </th>
            <th colspan="2" width="400px"  style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                BA RIKMATEK (Pemeriksaan Barang Teknik)
            </th>
            <th colspan="2" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                BAPB/BAPP
            </th>
            <th colspan="2" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                BAST
            </th>
            <th colspan="2" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Invoice
            </th>
            <th colspan="2" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Resi Kirim Invoice
            </th>
        </tr>
        <tr class="text-center dark:bg-meta-4">
            <th width="200px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Takon
            </th>
            <th width="200px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                HP
            </th>
            {{-- Jangka Waktu Kontrak Rinci --}}
            <th width="100px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Masa KR
            </th>
            <th width="100px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Awal KR
            </th>
            <th width="100px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Akhir KR
            </th>
            @if ($checkbox_cutting == 'true') 
            {{-- Proses Cutting --}}
            <th width="100px" style="background-color: #EBD2DD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Masuk
            </th>
            <th width="100px" style="background-color: #EBD2DD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Selesai
            </th>
            <th width="100px" style="background-color: #EBD2DD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Durasi
            </th>
            @endif
            @if ($checkbox_jahit == 'true') 
            {{-- Proses jahit --}}
            <th width="100px" style="background-color: #D4A6BD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Masuk
            </th>
            <th width="100px" style="background-color: #D4A6BD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Selesai
            </th>
            <th width="100px" style="background-color: #D4A6BD; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Durasi
            </th>
            @endif
            @if ($checkbox_packing == 'true') 
            {{-- Proses Packing --}}
            <th width="100px" style="background-color: #D9D3E9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Masuk
            </th>
            <th width="100px" style="background-color: #D9D3E9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal Selesai
            </th>
            <th width="100px" style="background-color: #D9D3E9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Durasi
            </th>
            @endif
            {{-- Pengiriman Barang --}}
            <th width="100px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Region
            </th>
            <th width="100px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                No Surat Jalan
            </th>
            <th width="100px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal
            </th>
            <th width="100px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Bukti Foto
            </th>
            <th width="100px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;  vertical-align: middle;">
                Nama Ekspedisi
            </th>
            {{-- Ba RIKMATEK --}}
            <th width="200px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                No
            </th>
            <th width="200px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Tanggal
            </th>
            {{-- BAPB/BAPP --}}
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                No
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Tanggal
            </th>
            {{-- BAST --}}
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                No
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Tanggal
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Nomor
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Tanggal
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Foto
            </th>
            <th width="100px" style="background-color: #A1CAEC; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center;  vertical-align: middle;">
                Tanggal Kirim
            </th>
        </tr>
    </thead>
    <tbody class="dark:bg-meta-4">
        @foreach ($dataKontrakRinci as $data)
            @php
                $totalBarang = $data->barangKontrak->count();
            @endphp            
            <tr>
                <td rowspan="{{$totalBarang}}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <h5 class="font-medium text-black dark:text-white">{{$loop->index + 1}}</h5>
                </td>
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black;  vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->takon ?? '-'}}</p>
                </td>
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black;  vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->no_telepon ?? '-'}}</p>
                </td>
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->tanggal_kontrak)
                            {{ \Carbon\Carbon::parse($data->tanggal_kontrak)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>            
                <!-- Periode KR dan Durasi Hari -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        {{\Carbon\Carbon::parse($data->awal_kr)->diffInDays(\Carbon\Carbon::parse($data->akhir_kr))}} Hari
                    </p>
                </td>

                <!-- Tanggal Awal KR -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                    <p class="text-black dark:text-white text-center">
                        @if($data->awal_kr)
                            {{ \Carbon\Carbon::parse($data->awal_kr)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>

                <!-- Tanggal Akhir KR -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white text-center">
                        @if($data->akhir_kr)
                            {{ \Carbon\Carbon::parse($data->akhir_kr)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>

                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white text-center">{{$data->uraian ?? '-'}}</p>
                </td>
                {{-- Item Barang Pertama --}}
                <td style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->barangKontrak->first()->dataProduk->nama_barang ?? '-'}}</p>
                </td>    
                <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->barangKontrak->first()->kuantitas ?? '-'}}</p>
                </td>    
                <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->barangKontrak->first()->satuan->nama_satuan ?? '-'}}</p>
                </td>
                {{-- Total Harga --}}
                @if ($loggedInUser->id_level_user == 1)
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    @if ($data->total_harga)
                    <p class="text-black dark:text-white text-center">    
                        {{ $data->total_harga ? 'Rp ' . number_format($data->total_harga, 0, ',', '.') : '-' }}
                    </p>
                    @else
                    -                    
                    @endif              
                </td>
                {{-- PPN --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    @if ($data->total_harga)
                    <p class="text-black dark:text-white text-center">    
                        Rp. {{ number_format(($data->total_harga/100)*$data->pajak->ppn, 2, ',', '.') }}
                        <br> 
                        ({{$data->pajak->ppn}} %)
                    </p>
                    @else         
                    -           
                    @endif     
                </td>
                {{-- Total Harga + PPN --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                    @if ($data->total_harga)
                    <p class="text-black dark:text-white text-center">    
                        Rp. {{ number_format($data->total_harga + ($data->total_harga/100)*$data->pajak->ppn, 2, ',', '.') }}
                    </p>
                    @else
                    -                    
                    @endif     
                </td>
                @endif
                {{-- Proses Cutting --}}
                @if ($checkbox_cutting == 'true') 
                <!-- Tanggal Masuk Proses Cutting -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesCutting && $data->prosesCutting->tanggal_masuk)
                            {{ \Carbon\Carbon::parse($data->prosesCutting->tanggal_masuk)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td> 
                <!-- Tanggal Selesai Proses Cutting -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesCutting && $data->prosesCutting->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($data->prosesCutting->tanggal_selesai)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->prosesCutting->durasi ?? '-'}} Hari</p>
                </td>
                @endif       
                {{-- Proses Jahit --}}
                @if ($checkbox_jahit == 'true') 
                <!-- Tanggal Masuk Proses Jahit -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesJahit && $data->prosesJahit->tanggal_masuk)
                            {{ \Carbon\Carbon::parse($data->prosesJahit->tanggal_masuk)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td> 
                <!-- Tanggal Selesai Proses Jahit -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesJahit && $data->prosesJahit->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($data->prosesJahit->tanggal_selesai)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->prosesJahit->durasi ?? '-'}} Hari</p>
                </td>
                @endif           
                {{-- Proses Packing --}}
                @if ($checkbox_packing == 'true') 
                <!-- Tanggal Masuk Proses Packing -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesPacking && $data->prosesPacking->tanggal_masuk)
                            {{ \Carbon\Carbon::parse($data->prosesPacking->tanggal_masuk)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td> 
                <!-- Tanggal Selesai Proses Packing -->
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->prosesPacking && $data->prosesPacking->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($data->prosesPacking->tanggal_selesai)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->prosesPacking->durasi ?? '-'}} Hari</p>
                </td>
                @endif           
                {{-- Pengiriman Barang --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->pengirimanBarang->region->nama_region ?? '-'}}</p>
                </td>    
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->pengirimanBarang->no_surat_jalan ?? '-'}}</p>
                </td>   
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->pengirimanBarang && $data->pengirimanBarang->tanggal_surat_jalan)
                            {{ \Carbon\Carbon::parse($data->pengirimanBarang->tanggal_surat_jalan)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>            
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    @if($data->pengirimanBarang && $data->pengirimanBarang->bukti_foto)
                
                <img src="{{ public_path('storage/upload/dokumen_pengiriman_barang/' . $data->pengirimanBarang->bukti_foto) }}" alt="Bukti Foto" width="200px">
                
                    @else
                        <p class="text-black dark:text-white">-</p>
                    @endif
                </td>                
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->pengirimanBarang->ekspedisi->nama_ekspedisi ?? '-'}}</p>
                </td>
                {{-- BA RIKMATEK --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->ba_rikmatek->no ?? '-'}}</p>
                </td>    
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->ba_rikmatek && $data->ba_rikmatek->tanggal_ba_rikmatek)
                            {{ \Carbon\Carbon::parse($data->ba_rikmatek->tanggal_ba_rikmatek)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>                   
                {{-- BAPB/BAPP --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->bapb_bapp->no ?? '-'}}</p>
                </td>    
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->bapb_bapp && $data->bapb_bapp->tanggal_bapb_bapp)
                            {{ \Carbon\Carbon::parse($data->bapb_bapp->tanggal_bapb_bapp)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>                 
                {{-- BAST --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->bast->no ?? '-'}}</p>
                </td>    
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->bast && $data->bast->tanggal_bast)
                            {{ \Carbon\Carbon::parse($data->bast->tanggal_bast)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>               
                {{-- INVOICE --}}
                <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$data->invoice->nomor_invoice ?? '-'}}</p>
                </td>    
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->invoice && $data->invoice->tanggal_invoice)
                            {{ \Carbon\Carbon::parse($data->invoice->tanggal_invoice)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>            
                {{-- RESI KIRIM --}}
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    @if($data->invoice && $data->invoice->foto_invoice)
                    <img src="{{ public_path('storage/upload/dokumen_invoice/' . $data->invoice->foto_invoice) }}" alt="Bukti Foto" width="200px">
                    @else
                        <p class="text-black dark:text-white">-</p>
                    @endif
                </td>             
                <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">
                        @if($data->invoice && $data->invoice->tanggal_kirim_invoice)
                            {{ \Carbon\Carbon::parse($data->invoice->tanggal_kirim_invoice)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </p>
                </td>                  
            </tr>
            @foreach ($data->barangKontrak as $itemBarang)  
            @if($loop->first)
                @continue
            @endif              
            <tr>
                <td style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$itemBarang->dataProduk->nama_barang}}</p>
                </td>    
                <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$itemBarang->kuantitas}}</p>
                </td>    
                <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                    <p class="text-black dark:text-white">{{$itemBarang->satuan->nama_satuan}}</p>
                </td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>