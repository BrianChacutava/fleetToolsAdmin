<?php

namespace App\Http\Livewire\Tools;

use App\Models\Tool;
use Livewire\Component;
use Livewire\WithPagination;

class ToolControll extends Component
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
        $tools = Tool::where('name', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.tools.tool-controll',[
            "Tools"=>$tools
        ]);
    }
}
