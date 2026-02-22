<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $user;

    public function mount()
    {
        // dd(Auth::user());
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.profile', [
            'user' => $this->user,
        ])->layout('layouts.app');
    }
}
