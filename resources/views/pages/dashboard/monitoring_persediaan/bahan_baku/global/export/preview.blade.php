<table class="w-full table-auto">
    <thead class="bg-blue-600 text-white">
        <tr>
            @php
                $currentYear = date('Y');
            @endphp
            <th colspan="7" rowspan="2" style="border:1px solid black; background: #FFFF00; font-size: 20px; color: black; text-align: center; font-weight: bold;" class="py-[20px] dark:bg-meta-4">PERSEDIAAN KAIN {{$currentYear}}</th>
        </tr>
        <tr></tr>
        <tr class="dark:bg-meta-4">
            <th class="min-w-[50px] font-medium dark:text-white" style="border:1px solid black; text-align: center; color:#FFFFFF; background: #ff0000;">
                No
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;" width="150px">
                NO ID
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;"  width="150px">
                Nama Barang
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;" width="150px">
                Warna
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;" width="150px">
                Kode Warna
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;" width="150px">
                Total Panjang
            </th>
            <th class="font-medium dark:text-white" style="border:1px solid black; text-align: left; color:#FFFFFF; background: #ff0000;" width="150px">
                Satuan
            </th>
        </tr>
    </thead>
    <tbody class="dark:bg-meta-4">
        @foreach ($data as $item)
        <tr>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <h5 class="dark:text-white" style="text-align: center; color:black;">{{$loop->index + 1}}</h5>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->id_no}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->nama_barang}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->warna->nama_warna}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->warna->kode_warna}}</p>
            </td>
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->totalSisaStok}}</p>
            </td>               
            <td class="border-b border-[#eee] dark:border-strokedark" style="border:1px solid black;">
                <p class="text-black dark:text-white">{{$item->satuanNamaTotal}}</p>
            </td>                                          
        </tr>
        @endforeach
    </tbody>
</table>