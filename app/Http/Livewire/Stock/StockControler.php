<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use App\Models\Company;
use Livewire\Component;

class StockControler extends Component
{

    public Stock $stocks;
    public $showSuccesNotification = false;

    public function mount()
    {
        $this->stocks = new Stock();
    }
    public function render()
    {
        $companies = Company::all();
        $stockList = Stock::paginate(10);

        return view('livewire.stock.stock-controler', compact('companies', 'stockList'));
    }



    protected $rules = [
        'stocks.name' => 'max:40|min:3',
        'stocks.description' => 'max:500',
        'stocks.company_id' => 'min:1'
    ];


    public function save()
    {

        $this->validate();
        $this->stocks->save();


        $this->showSuccesNotification = true;
        session()->flash('message', 'Company criada com sucesso.');


        $companies = Company::all();
        return view('livewire.stock.stock-controler', compact('companies'));

        // ...
    }


    public function delete($id)
    {
        $stock = Stock::findOrFail($id);

        $stock->delete();
        session()->flash('message', 'Stock apagado com sucesso.');
        return redirect()->route('stock.index');
    }
}
