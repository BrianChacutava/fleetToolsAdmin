<?php

namespace App\Http\Livewire\Tools;

use Livewire\Component;
use App\Models\ToolGroup;

class ToolGroupForm extends Component
{
    public $groupId = null;
    public $name = '';
    public $descricao = '';

    protected $rules = [
        'name' => 'required|max:100',
        'description' => 'nullable|max:500',
    ];

    public ToolGroup $group;

    public function mount()
    {
        $this->group = new ToolGroup();
    }

    public function save()
    {
        $this->validate();

        if ($this->groupId) {
            $g = ToolGroup::find($this->groupId);
            if ($g) {
                $g->update([
                    'name' => $this->name,
                    'descricao' => $this->descdescricaoription,
                ]);
                session()->flash('message', 'Tool group updated.');
            }
        } else {
            ToolGroup::create([
                'name' => $this->name,
                'description' => $this->descricao,
            ]);
            session()->flash('message', 'Tool group created.');
        }

        return redirect()->route('Tool-Group');
    }

    public function render()
    {
        return view('livewire.tools.tool-group-form')->layout('layouts.app');
    }
}
