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
            @if ($loggedInUser->id_level_user === 1)                
            <th width="200px" rowspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Total Harga
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
        <tr class="text-left dark:bg-meta-4">
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
        <tr>
            <td rowspan="{{$totalBarang}}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                <h5 class="font-medium text-black dark:text-white">1</h5>
            </td>
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black;  vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->takon ?? '-'}}</p>
            </td>
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black;  vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->no_telepon ?? '-'}}</p>
            </td>
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->tanggal_kontrak)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->tanggal_kontrak)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>            
            <!-- Periode KR dan Durasi Hari -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->awal_kr && $dataKontrakRinci->akhir_kr)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->awal_kr)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($dataKontrakRinci->akhir_kr)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                    <br> ({{ $durasiHari ?? '-' }} Hari)
                </p>
            </td>

            <!-- Tanggal Awal KR -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black;  vertical-align: middle;">
                <p class="text-black dark:text-white text-left">
                    @if($dataKontrakRinci->awal_kr)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->awal_kr)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>

            <!-- Tanggal Akhir KR -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white text-left">
                    @if($dataKontrakRinci->akhir_kr)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->akhir_kr)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>

            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white text-left">{{$dataKontrakRinci->uraian ?? '-'}}</p>
            </td>
            {{-- Item Barang Pertama --}}
            <td style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->barangKontrak->first()->dataProduk->nama_barang ?? '-'}}</p>
            </td>    
            <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->barangKontrak->first()->kuantitas ?? '-'}}</p>
            </td>    
            <td  style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->barangKontrak->first()->satuan->nama_satuan ?? '-'}}</p>
            </td>
            {{-- Total Harga --}}
            @if ($loggedInUser->id_level_user === 1)              
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white text-left">    
                    {{ $dataKontrakRinci->total_harga ? 'Rp ' . number_format($dataKontrakRinci->total_harga, 0, ',', '.') : '-' }}
                </p>
            </td>
            @endif
            {{-- Proses Cutting --}}
            @if ($checkbox_cutting == 'true') 
            <!-- Tanggal Masuk Proses Cutting -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesCutting && $dataKontrakRinci->prosesCutting->tanggal_masuk)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesCutting->tanggal_masuk)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td> 
            <!-- Tanggal Selesai Proses Cutting -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesCutting && $dataKontrakRinci->prosesCutting->tanggal_selesai)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesCutting->tanggal_selesai)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->prosesCutting->durasi ?? '-'}} Hari</p>
            </td>
            @endif       
            {{-- Proses Jahit --}}
            @if ($checkbox_jahit == 'true') 
            <!-- Tanggal Masuk Proses Jahit -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesJahit && $dataKontrakRinci->prosesJahit->tanggal_masuk)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesJahit->tanggal_masuk)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td> 
            <!-- Tanggal Selesai Proses Jahit -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesJahit && $dataKontrakRinci->prosesJahit->tanggal_selesai)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesJahit->tanggal_selesai)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->prosesJahit->durasi ?? '-'}} Hari</p>
            </td>
            @endif           
            {{-- Proses Packing --}}
            @if ($checkbox_packing == 'true') 
            <!-- Tanggal Masuk Proses Packing -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesPacking && $dataKontrakRinci->prosesPacking->tanggal_masuk)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesPacking->tanggal_masuk)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td> 
            <!-- Tanggal Selesai Proses Packing -->
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->prosesPacking && $dataKontrakRinci->prosesPacking->tanggal_selesai)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->prosesPacking->tanggal_selesai)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->prosesPacking->durasi ?? '-'}} Hari</p>
            </td>
            @endif           
            {{-- Pengiriman Barang --}}
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->pengirimanBarang->region->nama_region ?? '-'}}</p>
            </td>    
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->pengirimanBarang->no_surat_jalan ?? '-'}}</p>
            </td>   
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->pengirimanBarang && $dataKontrakRinci->pengirimanBarang->tanggal_surat_jalan)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->pengirimanBarang->tanggal_surat_jalan)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>            
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                @if($dataKontrakRinci->pengirimanBarang && $dataKontrakRinci->pengirimanBarang->bukti_foto)
            
            <img src="{{ url('storage/upload/dokumen_pengiriman_barang/' . $dataKontrakRinci->pengirimanBarang->bukti_foto) }}" alt="Bukti Foto" width="200px">
            
                @else
                    <p class="text-black dark:text-white">Gambar tidak tersedia</p>
                @endif
            </td>                
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->pengirimanBarang->ekspedisi->nama_ekspedisi ?? '-'}}</p>
            </td>
            {{-- BA RIKMATEK --}}
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->ba_rikmatek->no ?? '-'}}</p>
            </td>    
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->ba_rikmatek && $dataKontrakRinci->ba_rikmatek->tanggal_ba_rikmatek)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->ba_rikmatek->tanggal_ba_rikmatek)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>                   
            {{-- BAPB/BAPP --}}
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->bapb_bapp->no ?? '-'}}</p>
            </td>    
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->bapb_bapp && $dataKontrakRinci->bapb_bapp->tanggal_bapb_bapp)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->bapb_bapp->tanggal_bapb_bapp)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>                 
            {{-- BAST --}}
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->bast->no ?? '-'}}</p>
            </td>    
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->bast && $dataKontrakRinci->bast->tanggal_bast)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->bast->tanggal_bast)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>               
            {{-- INVOICE --}}
            <td rowspan="{{$totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">{{$dataKontrakRinci->invoice->nomor_invoice ?? '-'}}</p>
            </td>    
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->invoice && $dataKontrakRinci->invoice->tanggal_invoice)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->invoice->tanggal_invoice)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>            
            {{-- RESI KIRIM --}}
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; text: black; border:1px solid black; vertical-align: middle;">
                @if($dataKontrakRinci->invoice && $dataKontrakRinci->invoice->foto_invoice)
                
                <img src="{{ url('storage/upload/dokumen_invoice/' . $dataKontrakRinci->invoice->foto_invoice) }}" alt="Bukti Foto" width="200px">
                
                @else
                    <p class="text-black dark:text-white">Gambar tidak tersedia</p>
                @endif
            </td>             
            <td rowspan="{{ $totalBarang }}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; vertical-align: middle;">
                <p class="text-black dark:text-white">
                    @if($dataKontrakRinci->invoice && $dataKontrakRinci->invoice->tanggal_kirim_invoice)
                        {{ \Carbon\Carbon::parse($dataKontrakRinci->invoice->tanggal_kirim_invoice)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
            </td>                  
        </tr>
        @foreach ($dataKontrakRinci->barangKontrak as $itemBarang)  
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
    </tbody>
</table>