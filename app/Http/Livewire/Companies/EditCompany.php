<?php

namespace App\Http\Livewire\Companies;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class EditCompany extends Component
{
    use WithFileUploads;

    public $logo;
    public Company $company;

    public function mount($id)
    {
        $this->company = Company::findOrFail($id);
    }

    protected $rules = [
        'company.name' => 'required|string|max:255',
        'company.acronym' => 'nullable|string|max:50',
        'company.email' => 'nullable|email|max:255',
        'company.adress' => 'nullable|string|max:255',
        'company.nuit' => 'nullable|string|max:100',
        'logo' => 'nullable|image|max:1024',
    ];

    public function save()
    {
        $this->validate();
        if ($this->logo) {
            // remove old logo if exists
            if ($this->company->logo && Storage::disk('public')->exists($this->company->logo)) {
                Storage::disk('public')->delete($this->company->logo);
            }

            $this->company->logo = $this->logo->store('logos', 'public');
        }

        $this->company->save();
        session()->flash('message', 'Company atualizada com sucesso.');
        return redirect()->route('companies.index');
    }

    public function removeLogo()
    {
        if ($this->company->logo && Storage::disk('public')->exists($this->company->logo)) {
            Storage::disk('public')->delete($this->company->logo);
        }

        $this->company->logo = null;
        $this->company->save();
        $this->logo = null;
        session()->flash('message', 'Logo removido com sucesso.');
        // stay on the same page; Livewire will re-render
    }

    public function render()
    {
        return view('livewire.companies.edit-company')->layout('layouts.app');
    }
}
