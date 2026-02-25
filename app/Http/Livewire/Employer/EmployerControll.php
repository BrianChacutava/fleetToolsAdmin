<?php

namespace App\Http\Livewire\Employer;

use App\Models\Employer;
use Livewire\Component;
use Livewire\WithPagination;

class EmployerControll extends Component
{

    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    public $search = '';



    public function updatingSearch()

    {

        $this->resetPage();

    }
    public function render()
    {
        $Employers = Employer::where('first_name', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.employer.employer-controll',[
            "Employers"=>$Employers
        ]);
    }
}
