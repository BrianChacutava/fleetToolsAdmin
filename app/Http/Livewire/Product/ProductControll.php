<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductControll extends Component
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
        $product = Product::where('name', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.product.product-controll',[
            "Products"=>$product
        ]);
    }
}
