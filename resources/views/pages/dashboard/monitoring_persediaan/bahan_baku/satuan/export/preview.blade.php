<table class="w-full table-auto">
    <thead>
        <tr class="text-left dark:bg-meta-4">
            <th rowspan="3" class="dark:text-white"  style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="50px">
                No
            </th>
            <th rowspan="3" class="text-center px-4 py-4 font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                NO ID
            </th>
            <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Nama Barang
            </th>
            <th rowspan="3" class="px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Warna
            </th>
            <th rowspan="3" class="min-w-[150px] px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Kode Warna
            </th>
            <th colspan="{{$jumlahHari*2}}" class="px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Tanggal
            </th>
            <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Total Kain Masuk
            </th>
            <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Total Kain Keluar
            </th>
            <th rowspan="3" class="min-w-[200px] px-4 py-4 text-center font-medium text-white dark:text-white" style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;" width="150px">
                Total Sisa Kain
            </th>
        </tr>
        <tr>
            @foreach ($dateRange as $item)                        
            <th colspan="2" class="dark:text-white dark:bg-meta-4"  style="background-color: #4c1030; color: white; text-align: center; vertical-align: middle; border: 1px solid black;" width="150px">
                {{$item}}{{-- //tanggalnya --}}
            </th>
            @endforeach
        </tr>
        <tr>
            @foreach ($dateRange as $item)                        
                <th class="dark:text-white" style="background-color: darkgreen; text-align: center; font-weight: 500; padding-left: 8px; padding-right: 8px; color:white; border: 1px solid black;" width="75px">
                    Masuk
                </th>
                <th class="dark:text-white" style="background-color: red; text-align: center; font-weight: 500; padding-left: 8px; padding-right: 8px; color:white; border: 1px solid black;" width="75px">
                    Keluar
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="dark:bg-meta-4">
        @foreach ($data as $item)                    
            <tr>
                <td class="" style="color:#000000; border: 1px solid black;">
                    <h5 class="dark:text-white">{{$loop->index + 1}}</h5>
                </td>
                <td class="" style="color:#000000; border: 1px solid black;">
                    <p class="dark:text-white">{{$item->id_no}}</p>
                </td>
                <td class="" style="color:#000000; border: 1px solid black;">
                    <p class="dark:text-white">{{$item->nama_barang}}</p>
                </td>
                <td class="" style="color:#000000; border: 1px solid black;">
                    <p class="dark:text-white">{{$item->warna->nama_warna}}</p>
                </td>
                <td class="" style="color:#000000; border: 1px solid black;">
                    <p class="dark:text-white">{{$item->warna->kode_warna}}</p>
                </td>
                @foreach ($dateRange as $range)
                <td class="px-6 py-4 whitespace-nowrap text-center" style="text-align: center; color:#000000; border: 1px solid black;">
                    @php
                        $stok = $item->stokHarian->firstWhere('tanggal', $range);
                        $stokMasuk = optional($stok)->stok_masuk ?? 0;
                        $stokKeluar = optional($stok)->stok_keluar ?? 0;
                        $satuanId = optional($stok)->id_satuan;
                        $satuanNama = optional($stok)->satuan->nama_satuan ?? '-';

                        if ($id_satuan == '1' && $satuanId == '2') { // Yard to Meter
                            $stokMasuk = round($stokMasuk / 1.09361, 2);
                            $stokKeluar = round($stokKeluar / 1.09361, 2);
                            $satuanNama = 'Meter';
                        } elseif ($id_satuan == '2' && $satuanId == '1') { // Meter to Yard
                            $stokMasuk = round($stokMasuk * 1.09361, 2);
                            $stokKeluar = round($stokKeluar * 1.09361, 2);
                            $satuanNama = 'Yard';
                        }
                    @endphp
                    <p class="dark:text-white">
                        {{ $stokMasuk ?? '-' }}
                    </p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap" style="text-align: center; color:#000000; border: 1px solid black;">
                    <p class="dark:text-white">
                        {{ $stokKeluar ?? '-' }}
                    </p>
                </td>
            @endforeach
                <td class="" style="color: #000000; text-align: left; border: 1px solid black;">
                    <p class="dark:text-white">{{ $totalStokMasuk[$item->id] ?? 0 }}</p>
                </td>
                <td class="" style="color: #000000; text-align: left; border: 1px solid black;">
                    <p class="dark:text-white">{{ $totalStokKeluar[$item->id] ?? 0 }}</p>
                </td>
                <td class="" style="background-color: #FF0000; color: white; text-align: left; border: 1px solid black;">
                    <p class="dark:text-white">{{ $totalStokMasuk[$item->id] - $totalStokKeluar[$item->id] }}</p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>