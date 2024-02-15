<?php

namespace App\Http\Livewire\Tools;

use App\Models\Company;
use App\Models\Employer;
use App\Models\OperationOut;
use App\Models\Stock;
use App\Models\Tool;
use App\Models\ToolsHasStock;
use Livewire\Component;

class ToolRequest extends Component
{
    public ToolsHasStock $req;
    public OperationOut $out;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->req = new ToolsHasStock();
        $this->out = new OperationOut();
    }


    public $showSuccesNotification  = false;
    public $showFailureNotification = false;
    public function render()
    {

        return view('livewire.tools.tool-request', [
            'toolList' => Tool::paginate(10),
            'requestList' => ToolsHasStock::orderBy('id', 'DESC')->paginate(10),
            'companyList' => Company::all(),
            'stockList' => Stock::all(),
            'TecnicalList' => Employer::all()
        ]);
    }


    protected $rules = [
        'req.tools_id' => 'min:1',
        'req.stock_id' => 'min:1',
        'req.quantity' => 'min:1',
        'req.employer_id' => 'min:1',
        'out.description' => 'min:10',
        'out.initial_time' => 'date',
        'out.company_id' => 'min:1'
    ];

    public function save()
    {

        if ($this->validate()) {
            $tool = Tool::find($this->req->tools_id);

            if ($tool->quantity >= $this->req->quantity) {

                $this->req->last_qty = $tool->quantity;
                $this->updateTool($tool, $this->req->quantity);

                $this->req->atual_qty = $tool->quantity;
                $this->req->operation_type = 'O';
                $this->req->save();

                $this->req->operation_out_id = $this->saveOperationOut($this->req)->id;
                $this->req->save();

            } else {
                $this->showFailureNotification = true;
            }

            $this->showSuccesNotification = true;
        }
    }

    public function saveOperationOut(ToolsHasStock $req)
    {

        $this->out->status = 'out';

        return $addStock = OperationOut::create([
            'description' => $this->out->description,
            'initial_time' => $this->out->initial_time,
            // 'finish_time' => $this->out->finish_time,
            'status' => $this->out->status,
            'company_id' => $this->out->company_id,
        ]);


    }
    public function updateTool(Tool $tool, $new_qty)
    {

        $tool->quantity = $tool->quantity - $new_qty;
        $tool->save();
    }
}
