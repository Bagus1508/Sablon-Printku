<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppLayout extends Component
{
    public function render()
    {   
        $user = Auth::user();

        return view('layouts.app', compact('user'));
    }
}
