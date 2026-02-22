<?php

namespace App\Http\Livewire\Product;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProductHasStock;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
     use WithFileUploads;

    public Product $products;
    public $stock1 = '';
    public $photo;

    public $showSuccesNotification  = false;
    public $showFailureNotification = false;
    public $showDemoNotification = false;


    public function mount()
    {
        $this->products = new Product();
    }
    public function render()
    {
        $companies = Company::all();
        $product_groups = ProductGroup::all();
        $stocks = Stock::all();
        return view('livewire.product.product-create', [
            'companies' => $companies,
            'product_groups' => $product_groups,
            'stocks' => $stocks
        ]);
    }


    protected $rules = [
        'products.name' => 'max:40|min:3',
        'products.make' => 'max:200',
        'products.model' => 'max:40',
        'products.active' => 'max:2',
        'products.reference_num' => 'min:4',
        'products.status' => 'max:10',
        'products.quantity' => 'min:0',
        'products.description' => 'max:500',
        'products.company_id' => 'min:1',
        'products.product_group_id' => 'min:0',
        'photo' => 'image|max:1024', // 1MB Max
        'stock1' => 'min:0'
    ];


    public function save()
    {

        if ($this->validate()) {
            $this->products->active = 1;
            $this->products->photo = $this->photo->store('photos','public');
            $this->products->save();


            if ($this->products->quantity > 0) {
                $addStock = ProductHasStock::create([
                    'product_id' => $this->products->id,
                    'stock_id' => $this->stock1,
                    'operation_type' => 'E',
                    'quantity' => $this->products->quantity,
                    'last_qty' => 0,
                    'atual_qty' => $this->products->quantity,
                    'employer_id' => 1
                ]);
            }


            $this->showSuccesNotification = true;

            session()->flash('message', 'Products successfully created.');
            $products = Product::paginate(10);
            return redirect()->to('/product/product-controll');
        } else {
            dd($this->products);
            $this->showFailureNotification = true;
        }
        $products = Product::paginate(10);
        return view('livewire.product.product-controll', [
            "Products" => $products
        ]);

        // ...
    }
}
