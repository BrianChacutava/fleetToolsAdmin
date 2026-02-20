<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class CompaniesManager extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDelete = false;
    public $deleteId = null;

    protected $paginationTheme = 'bootstrap';

    // Validation is handled in CreateCompany / EditCompany components now.

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $companies = Company::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.companies.manage-companies', [
            'companies' => $companies,
        ])->layout('layouts.app');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->deleteId = null;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Company::findOrFail($this->deleteId)->delete();
            session()->flash('message', 'Company apagada.');
        }

        $this->cancelDelete();
        $this->resetPage();
    }
}
