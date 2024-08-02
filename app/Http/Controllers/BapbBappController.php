<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\BapbBapp;
use App\Models\BaRikmatek;
use App\Models\KontrakRinci;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class BapbBappController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kontrak_rinci' => 'required',
            'no' => 'nullable',
            'tanggal_bapb_bapp' => 'nullable|date',
        ]);

        $existingDataBapbBapp = BapbBapp::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->exists();
        $dataKontrakRinci = KontrakRinci::where('id', $validated['id_kontrak_rinci'])->first();

        if($existingDataBapbBapp == false){
            BapbBapp::create([
                'id_kontrak_rinci' => $validated['id_kontrak_rinci'],
                'no' => $validated['no'],
                'tanggal_bapb_bapp' => $validated['tanggal_bapb_bapp'],
            ]);
        } else {
            $data = BapbBapp::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->first();
            $data->no = $validated['no'];
            $data->tanggal_bapb_bapp = $validated['tanggal_bapb_bapp'];
            $update = $data->save();
        }


        Alert::success('Berhasil!', 'Berhasil update data BAPB/BAPP dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
        LogHelper::success('Berhasil mengubah update data BAPB/BAPP dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
        return redirect()->back();
        try {
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
