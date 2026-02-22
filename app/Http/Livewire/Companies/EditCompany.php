<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCompany extends Component
{
    use WithFileUploads;

    public $logo;
    public Company $company;

    public function mount(Request $request)
    {
        // dd($request->input('id'));
        $this->company = Company::findOrFail($request->input('id'));
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

    public function delete($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();
        session()->flash('message', 'Empresa apagada com sucesso.');
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
