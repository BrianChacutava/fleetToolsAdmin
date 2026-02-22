<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductGroup;
use Livewire\Component;
use Livewire\WithPagination;

class ProductGroupControll extends Component
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
        $group = ProductGroup::find($id);
        if ($group) {
            $group->delete();
            session()->flash('message', 'Product group deleted.');
        }
    }

    protected $rules = [
        'name' => 'required|max:100',
        'descricao' => 'nullable|max:500',
    ];

    public function openCreate()
    {
        $this->resetForm();
        $this->dispatchBrowserEvent('show-product-group-modal');
    }

    public function openEdit($id)
    {
        $group = ProductGroup::find($id);
        if (!$group) {
            session()->flash('message', 'Product group not found.');
            return;
        }
        $this->editingId = $group->id;
        $this->name = $group->name;
        $this->descricao = $group->descricao;
        $this->dispatchBrowserEvent('show-product-group-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $group = ProductGroup::find($this->editingId);
            if ($group) {
                $group->update([
                    'name' => $this->name,
                    'descricao' => $this->descricao,
                ]);
                session()->flash('message', 'Product group updated.');
            }
        } else {
            ProductGroup::create([
                'name' => $this->name,
                'descricao' => $this->descricao,
            ]);
            session()->flash('message', 'Product group created.');
        }

        $this->dispatchBrowserEvent('hide-product-group-modal');
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
        $groups = ProductGroup::where('name', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.product.product-group-controll', [
            'ProductGroups' => $groups,
        ]);
    }
}
