<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\UserLevel;

class AccountTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 15;
    public $filter, $ID, $Name, $Email, $Id_level_user;

    protected $listeners = [
        'editUser' => 'editUser'
    ];    

    public $isModalOpen = false;

    public function editUser(int $id){
        $this->ID = $id;
        $data = User::findOrFail($id);

        $this->Name = $data->name; // Sesuaikan dengan nama properti yang benar
        $this->Email = $data->email; // Sesuaikan jika perlu
        $this->Id_level_user = $data->id_level_user; // Sesuaikan jika perlu
    }    

    public function deleteUser(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = User::orderBy('id','desc')
        ->where('name','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $dataLevelUser = UserLevel::all();

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.account-table',[
            'data' => $Data,
            'user' => User::all(),
            'dataLevelUser' => $dataLevelUser,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}