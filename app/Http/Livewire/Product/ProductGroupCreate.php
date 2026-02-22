<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductGroup;
use Livewire\Component;

class ProductGroupCreate extends Component
{

    public $groupId = null;
    public $name = '';
    public $description = '';

    protected $rules = [
        'name' => 'required|max:100',
        'description' => 'nullable|max:500',
    ];

    public ProductGroup $group;

    public function mount()
    {
        $this->group = new ProductGroup();
    }

    public function save()
    {
        $this->validate();

        if ($this->groupId) {
            $g = ProductGroup::find($this->groupId);
            if ($g) {
                $g->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
                session()->flash('message', 'Product group updated.');
            }
        } else {
            ProductGroup::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Product group created.');
        }

        return redirect()->route('Product-Group');
    }

    public function render()
    {
        return view('livewire.product.product-group-create');
    }
}
