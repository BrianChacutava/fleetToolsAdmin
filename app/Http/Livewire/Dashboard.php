<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Employer;
use App\Models\OperationOut;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Tool;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $users;
    public $products;
    public $companies;
    public $employers;
    public $tools;
    public $operations;
    public $stocks;


    public function mount()
    {
        $this->users = User::all();
        $this->products = Product::all(); // Assuming you have a Product model
        $this->companies = Company::all(); // Assuming you have a Company model
        $this->employers = Employer::all(); // Assuming you have an Employer model
        $this->tools = Tool::all(); // Assuming you have a Tool model
        $this->operations = OperationOut::all(); // You can populate this with actual operations if needed
        $this->stocks = Stock::all(); // Assuming you have a Stock model
    }

    public function countItems($collection)
    {
        return $collection->count();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'users' => $this->users,
            'products' => $this->products,
            'companies' => $this->companies,
            'employers' => $this->employers,
            'tools' => $this->tools,
            'operations' => $this->operations,
            'stocks' => $this->stocks]);
    }
}
