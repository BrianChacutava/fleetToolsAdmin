<?php

namespace App\Http\Livewire\Tools;

use App\Models\Tool;
use Livewire\Component;

class ToolControll extends Component
{
    public function render()
    {
        $tools = Tool::paginate(10);
        return view('livewire.tools.tool-controll',[
            "Tools"=>$tools
        ]);
    }
}
