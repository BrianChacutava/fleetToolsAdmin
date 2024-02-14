<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use App\Models\Company;
use Livewire\Component;

class StockControler extends Component
{

    public Stock $stocks;

    public function mount() {
        $this->stocks = new Stock();
    }
    public function render()
    {
        $companies = Company::all();
        $stockList = Stock::paginate(10);

        return view('livewire.stock.stock-controler',compact('companies', 'stockList'));
    }


    public $showSuccesNotification  = false;
    public $showFailureNotification = false;

    protected $rules = [
        'stocks.name' => 'max:40|min:3',
        'stocks.description' => 'max:500',
        'stocks.company_id' => 'min:1'
    ];


    public function save()
    {

        if($this->validate()){
        $this->stocks->save();
            $this->showSuccesNotification = true;
        }else{
            $this->showFailureNotification = true;

        }


        $companies = Company::all();
        return view('livewire.stock.stock-controler',compact('companies'));

        // ...
    }

}
