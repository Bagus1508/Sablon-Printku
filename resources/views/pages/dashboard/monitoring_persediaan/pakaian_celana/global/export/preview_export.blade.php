<table class="w-full table-auto">
    <thead class="bg-blue-600 text-white">
        <tr>
            @php
                $currentYear = date('Y');
            @endphp
            <th colspan="8" rowspan="2" style="background: #FFFF00; font-size: 20px; color: black; text-align: center; font-weight: bold; border: 1px solid black;" class="py-[20px] dark:bg-meta-4">PERSEDIAAN PAKAIAN DAN CELANA {{$currentYear}}</th>
        </tr>
        <tr></tr>
        <tr class="dark:bg-meta-4">
            <th class="min-w-[50px] font-medium dark:text-white" style="text-align: center; color:#FFFFFF; background: #ff0000; border: 1px solid black;">
                No
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                NO ID
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;"  width="150px">
                Nama Barang
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                Warna
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                Kode Warna
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                Perusahaan
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                Total Barang
            </th>
            <th class="font-medium dark:text-white" style="text-align: left; color:#FFFFFF; background: #ff0000; border: 1px solid black;" width="150px">
                Satuan
            </th>
        </tr>
    </thead>
    <tbody class="dark:bg-meta-4">
        @foreach ($data as $item)
        <tr>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <h5 class="dark:text-white" style="text-align: center; color:black;">{{$loop->index + 1}}</h5>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->id_no}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->nama_barang}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->warna->nama_warna}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->warna->kode_warna}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->perusahaan->nama_perusahaan}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{$item->totalSisaStok}}</p>
            </td>               
            <td class="border-b border-[#eee] dark:border-strokedark" style="border: 1px solid black;">
                <p class="text-black dark:text-white">{{ optional(optional($item->stokHarian->first())->satuan)->nama_satuan }}</p>
            </td>                                          
        </tr>
        @endforeach
    </tbody>
</table>