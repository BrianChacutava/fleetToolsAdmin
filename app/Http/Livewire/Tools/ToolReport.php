<?php

namespace App\Http\Livewire\Tools;

use App\Models\Tool;
use App\Models\ToolsHasStock;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class ToolReport extends Component
{
    use WithPagination;

    public Tool $tool;
    protected $paginationTheme = 'bootstrap';

    public function mount(Request $request)
    {
        $this->tool = Tool::findOrFail($request->input('toolId'));
    }


    public function render()
    {
        return view('livewire.tools.tool-report', [
            'tool' => $this->tool,
            'movimentacoes' => ToolsHasStock::where('tools_id', $this->tool->id)
                ->with(['employer', 'stock', 'operation_out'])
                ->orderBy('created_at', 'DESC')
                ->paginate(10)
        ])->layout('layouts.app');
    }
}
