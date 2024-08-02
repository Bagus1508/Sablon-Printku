<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
use Throwable;

class AccountController extends Controller
{
    public function index(){
        $dataLevelUser = UserLevel::all();
        return view('pages.dashboard.data_master.data_akun.index', compact('dataLevelUser'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'level' => 'required',
                'password' => 'required',
            ], [
                'email.unique' => 'Username ' . $request->email . ' sudah digunakan oleh pengguna lain.',
                'email.required' => 'Username tidak boleh kosong.',
                'level.required' => 'Level user tidak boleh kosong.',
                'password.required' => 'Password user tidak boleh kosong.',
            ]);
            

            $parameter = [
                'name'          => $validated['name'],
                'email'         => $validated['email'],
                'id_level_user' => $validated['level'],
                'password'      => Hash::make($validated['password'])
            ];
    
            $User = User::create($parameter);
    
            if (!$User) {
                Alert::error('Gagal!', 'Gagal menambahkan akun');
                LogHelper::error('Gagal menambahkan akun!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah user');
            LogHelper::success('Berhasil menambahkan akun.');
            return redirect()->back();
            
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        }/*  catch (Throwable $e) {
            return view('pages.utility.500');
        } */
    }

    public function update(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'name' => 'nullable',
                'email' => 'nullable',
                'level' => 'nullable',
                'password' => 'nullable',
            ]);

            $data = User::find($id);

            // Cek apakah email sudah digunakan oleh pengguna lain
            if (User::where('email', $validated['email'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Username/Email sudah digunakan oleh pengguna lain.');
                return redirect()->back();
            }

            if($validated['password'] != null){
                $data->name = $validated['name'];
                $data->email = $validated['email'];
                $data->id_level_user = $validated['level'];
                $data->password = bcrypt($validated['password']);
            } else if ($validated['password'] == null){
                $data->name = $validated['name'];
                $data->email = $validated['email'];
                $data->id_level_user = $validated['level'];
            }

            $User = $data->save();
            if (!$User) {
                Alert::error('Gagal!', 'Gagal mengubah data akun' .$data->name);
                LogHelper::error('Gagal mengubah data akun!');
                return redirect()->back();
            }

            Alert::success('Berhasil!', 'Berhasil mengubah data akun' .$data->name);
            LogHelper::success('Berhasil mengubah data akun.' .$data->name);
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.account.edit');
    }

    public function destroy($id)
    {
        try{
            $data = User::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data Bagian Unit Kerja!');
            toast('Berhasil menghapus data Bagian Unit Kerja!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
}
