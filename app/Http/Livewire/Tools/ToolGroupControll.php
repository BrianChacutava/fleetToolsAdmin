<?php

namespace App\Http\Livewire\Tools;

use App\Models\ToolGroup;
use Livewire\Component;
use Livewire\WithPagination;

class ToolGroupControll extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name = '';
    public $descricao = '';
    public $editingId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $group = ToolGroup::find($id);
        if ($group) {
            $group->delete();
            session()->flash('message', 'Tool group deleted.');
        }
    }

    protected $rules = [
        'name' => 'required|max:100',
        'description' => 'nullable|max:500',
    ];

    public function openCreate()
    {
        $this->resetForm();
        $this->dispatchBrowserEvent('show-tool-group-modal');
    }

    public function openEdit($id)
    {
        $group = ToolGroup::find($id);
        if (!$group) {
            session()->flash('message', 'Tool group not found.');
            return;
        }
        $this->editingId = $group->id;
        $this->name = $group->name;
        $this->descricao = $group->descricao;
        $this->dispatchBrowserEvent('show-tool-group-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $group = ToolGroup::find($this->editingId);
            if ($group) {
                $group->update([
                    'name' => $this->name,
                    'descricao' => $this->descricao,
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

        $this->dispatchBrowserEvent('hide-tool-group-modal');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->descricao = '';
    }

    public function render()
    {
        $groups = ToolGroup::where('name', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.tools.tool-group-controll', [
            'ToolGroups' => $groups,
        ]);
    }
}
