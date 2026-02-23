<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use App\Models\ProductHasStock;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReport extends Component
{

    use WithPagination;

    public Product $product;
    protected $paginationTheme = 'bootstrap';

    public function mount(Request $request)
    {
        $this->product = Product::findOrFail($request->input('productId'));
    }


    public function render()
    {
        return view('livewire.product.product-report', [
            'product' => $this->product,
            'movimentacoes' => ProductHasStock::where('product_id', $this->product->id)
                ->with(['employer', 'stock', 'operation_out'])
                ->orderBy('created_at', 'DESC')
                ->paginate(10)
        ])->layout('layouts.app');
    }

}
