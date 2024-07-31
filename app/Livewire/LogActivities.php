<?php

namespace App\Livewire;

use App\Models\LogHistory;
use Livewire\Component;
use Livewire\WithPagination;

class LogActivities extends Component
{
    use WithPagination;
    public function render()
    {
        $Logs = LogHistory::orderBy('created_at','desc')->paginate(5);
        return view('livewire.log-activities',[
            'logs'=> $Logs
        ]);
    }
}
