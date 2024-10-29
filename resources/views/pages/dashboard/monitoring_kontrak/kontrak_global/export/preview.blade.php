<table class="w-full table-auto">
    <thead>
        <tr class="dark:bg-meta-4">
            <th rowspan="2" width="50px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                No
            </th>
            <th width="400px" colspan="2" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                No Kontrak
            </th>
            <th rowspan="2" width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Tanggal
            </th>
            <th width="200px" rowspan="2" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Perusahaan
            </th>
            <th width="200px" rowspan="2" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Uraian Pekerjaan
            </th>
            <th width="200px" rowspan="2" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Nama Barang
            </th>
            <th rowspan="1" colspan="4" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Volume
            </th>
            @if ($loggedInUser->id_level_user === 1)   
            <th rowspan="2" width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Harga
            </th>
            <th rowspan="2" width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Sisa Harga
            </th>
            <th rowspan="2" width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                PPN ({{$dataPajak->ppn}}%)
            </th>
            <th rowspan="2" width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Harga + PPN ({{$dataPajak->ppn}}%)
            </th>
            @endif
            <th rowspan="1" colspan="2" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Jangka Waktu Kontrak
            </th>
            <th rowspan="2" width="200px" style="background-color: #D9EAD3; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                SPK Selesai
            </th>
        </tr>
        <tr class="text-left dark:bg-meta-4">
            <th width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Takon
            </th>
            <th width="200px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Pihak Pertama
            </th>
            <th width="100px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Satuan
            </th>
            <th width="100px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Kontrak
            </th>
            <th width="100px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Realisasi
            </th>
            <th width="100px" style="background-color: #D0DFE2; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Sisa
            </th>
            <th width="200px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Awal
            </th>
            <th width="200px" style="background-color: #C9DBF9; border: 1px solid black; padding-left: 40px; padding-right: 40px; white-space: nowrap; color: black; text-align: center; vertical-align: middle;">
                Akhir
            </th>
        </tr>
    </thead>
    <tbody class="dark:bg-meta-4">
        @foreach ($dataKontrak as $itemKontrak)
            @php
                $barangKontrakCount = $itemKontrak->barangKontrak->count();
            @endphp                    
            <tr>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <h5>{{$loop->index + 1}}</h5>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->takon}}</p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->no_kontrak_pihak_pertama}}</p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>                    
                        @if($itemKontrak->tanggal_kontrak && $itemKontrak->tanggal_kontrak)
                            {{ \Carbon\Carbon::parse($itemKontrak->tanggal_kontrak)->translatedFormat('d F Y') }}
                        @else
                            Kosong
                        @endif
                    </p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->perusahaan->nama_perusahaan ?? 'Kosong'}}</p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->uraian ?? 'Kosong'}}</p>
                </td>
                <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->barangKontrak->first()->dataProduk->nama_barang ?? 'Kosong'}}</p>
                </td>    
                <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->barangKontrak->first()->satuan->nama_satuan ?? 'Kosong'}}</p>
                </td>    
                <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->barangKontrak->first()->volume_kontrak ?? 'Kosong'}}</p>
                </td>    
                <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->barangKontrak->first()->volume_realisasi ?? 'Kosong'}}</p>
                </td>    
                <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>{{$itemKontrak->barangKontrak->first()->volume_sisa ?? 'Kosong'}}</p>
                </td>
                @if ($loggedInUser->id_level_user === 1)                    
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>
                        {{ 'Rp ' . number_format($itemKontrak->total_harga_old ?? 'Kosong', 0, ',', '.') }}
                    </p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>
                        {{ 'Rp ' . number_format($itemKontrak->total_harga ?? 'Kosong', 0, ',', '.') }}
                    </p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p class="text-black dark:text-white hover:underline">
                        Rp. {{ number_format(($itemKontrak->total_harga_old/100)*$dataPajak->ppn, 2, ',', '.') }}
                    </p>
                </td>
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p class="text-black dark:text-white hover:underline">
                        Rp. {{ number_format($itemKontrak->total_harga_old + ($itemKontrak->total_harga_old/100)*$dataPajak->ppn, 2, ',', '.') }}
                    </p>
                </td>
                    
                @endif
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>                    
                        @if($itemKontrak->awal_kr && $itemKontrak->awal_kr)
                            {{ \Carbon\Carbon::parse($itemKontrak->awal_kr)->translatedFormat('d F Y') }}
                        @else
                            Kosong
                        @endif
                    </p>
                </td>   
                <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                    <p>                    
                        @if($itemKontrak->akhir_kr && $itemKontrak->akhir_kr)
                            {{ \Carbon\Carbon::parse($itemKontrak->akhir_kr)->translatedFormat('d F Y') }}
                        @else
                            Kosong
                        @endif
                    </p>
                </td>
                @if ($itemKontrak->status_spk == false)
                    <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: #FFFFFF; background-color: #ff0000; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>
                            Belum Selesai
                        </p>
                    </td>   
                @else
                    <td rowspan="{{$barangKontrakCount}}" style="text-align: center; white-space: nowrap; color: #FFFFFF; background-color: #1aff00; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>
                            Selesai
                        </p>
                    </td>   
                @endif    
            </tr>
            @foreach ($itemKontrak->barangKontrak as $itemBarang)  
            @if($loop->first)
                @continue
            @endif    
                <tr>
                    <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>{{$itemBarang->dataProduk->nama_barang}}</p>
                    </td>    
                    <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>{{$itemBarang->satuan->nama_satuan}}</p>
                    </td>    
                    <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>{{$itemBarang->volume_kontrak}}</p>
                    </td>    
                    <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>{{$itemBarang->volume_realisasi}}</p>
                    </td>    
                    <td style="text-align: center; white-space: nowrap; color: black; border:1px solid black; align-items: center; justify-content: center;  vertical-align: middle;">
                        <p>{{$itemBarang->volume_sisa}}</p>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>