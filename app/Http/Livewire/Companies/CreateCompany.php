<?php

namespace App\Http\Livewire\Companies;

use Livewire\Component;
use App\Models\Company;

class CreateCompany extends Component
{
    public Company $company;

    public $showSuccesNotification = false;

    public function mount()
    {
        $this->company = new Company();
    }

    protected $rules = [
        'company.name' => 'required|string|max:255',
        'company.acronym' => 'nullable|string|max:50',
        'company.email' => 'nullable|email|max:255',
        'company.adress' => 'nullable|string|max:255',
        'company.nuit' => 'nullable|string|max:100',
    ];

    public function save()
    {
        $this->validate();

        $this->company->save();

        $this->showSuccesNotification = true;
        session()->flash('message', 'Company criada com sucesso.');

        return redirect()->to('/companies');
    }

    public function render()
    {
        return view('livewire.companies.create-company')->layout('layouts.app');
    }
}
