<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user(); // Ambil nama pengguna
    }

    public function render()
    {
        return view('livewire.header');
    }
}
