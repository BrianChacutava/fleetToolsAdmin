<?php

namespace App\Http\Livewire\Tools;

use App\Models\Tool;
use App\Models\Stock;
use App\Models\Company;
use Livewire\Component;
use App\Models\ToolGroup;
use GuzzleHttp\Psr7\Request;
use App\Models\ToolsHasStock;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;


class CreateTool extends Component
{
    use WithFileUploads;

    public Tool $tools;
    public $stock1 = '';
    public $photo;

    public $showSuccesNotification  = false;
    public $showFailureNotification = false;
    public $showDemoNotification = false;


    public function mount()
    {
        $this->tools = new Tool();
    }
    public function render()
    {
        $companies = Company::all();
        $tool_groups = ToolGroup::all();
        $stocks = Stock::all();
        return view('livewire.tools.create-tool', [
            'companies' => $companies,
            'tool_groups' => $tool_groups,
            'stocks' => $stocks
        ]);
    }


    protected $rules = [
        'tools.name' => 'max:40|min:3',
        'tools.make' => 'max:200',
        'tools.model' => 'max:40',
        'tools.active' => 'max:2',
        'tools.reference_num' => 'min:4',
        'tools.status' => 'max:10',
        'tools.quantity' => 'min:0',
        'tools.description' => 'max:500',
        'tools.company_id' => 'min:1',
        'tools.tool_group_id' => 'min:0',
        'photo' => 'image|max:1024', // 1MB Max
        'stock1' => 'min:0'
    ];


    public function save()
    {

        if ($this->validate()) {
            $this->tools->active = 1;
            $this->tools->photo = $this->photo->store('photos','public');
            $this->tools->save();


            if ($this->tools->quantity > 0) {
                $addStock = ToolsHasStock::create([
                    'tools_id' => $this->tools->id,
                    'stock_id' => $this->stock1,
                    'operation_type' => 'E',
                    'quantity' => $this->tools->quantity,
                    'last_qty' => 0,
                    'atual_qty' => $this->tools->quantity,
                    'employer_id' => 1
                ]);
            }


            $this->showSuccesNotification = true;

            session()->flash('message', 'Tools successfully created.');
            $tools = Tool::paginate(10);
            return redirect()->to('/tools/tool-controll');
        } else {
            $this->showFailureNotification = true;
        }
        $tools = Tool::paginate(10);
        return view('livewire.tools.tool-controll', [
            "Tools" => $tools
        ]);

        // ...
    }
}
