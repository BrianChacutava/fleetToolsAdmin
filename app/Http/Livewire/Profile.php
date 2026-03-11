<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class Profile extends Component
{
    use WithFileUploads;

    public $user;

    public function mount()
    {
        // dd(Auth::user());
        $this->user = Auth::user();
    }

    protected $rules = [

        'photo' => 'image|max:1024', // 1MB Max

    ];

    public function updateProfile()
    {
        $this->validate([
            'user.name' => 'required|max:255',
            'user.email' => 'required|email|max:255',
            // Adicione outras validações conforme necessário
        ]);

        $this->user->save();

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePhoto(Request $request)
    {~
            dd($request->file('photo'));
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');

             $this->user->photo = $path;
             $this->user->save();
        }

        return back()->with('success', 'Foto atualizada!');
    }

    public function render()
    {
        return view('livewire.profile', [
            'user' => $this->user,
        ])->layout('layouts.app');
    }
}
