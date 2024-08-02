<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Bast;
use App\Models\KontrakRinci;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class BastController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_kontrak_rinci' => 'required',
                'no' => 'nullable',
                'tanggal_bast' => 'nullable|date',
            ]);
    
            $existingDataBast = Bast::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->exists();
            $dataKontrakRinci = KontrakRinci::where('id', $validated['id_kontrak_rinci'])->first();
    
            if($existingDataBast == false){
                Bast::create([
                    'id_kontrak_rinci' => $validated['id_kontrak_rinci'],
                    'no' => $validated['no'],
                    'tanggal_bast' => $validated['tanggal_bast'],
                ]);
            } else {
                $data = Bast::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->first();
                $data->no = $validated['no'];
                $data->tanggal_bast = $validated['tanggal_bast'];
                $update = $data->save();
            }
    
    
            Alert::success('Berhasil!', 'Berhasil update data BAST dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah update data BAST dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
