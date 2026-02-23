<?php

namespace App\Http\Livewire\Product;

use App\Models\Company;
use App\Models\Employer;
use App\Models\OperationOut;
use App\Models\Product;
use App\Models\ProductHasStock;
use App\Models\Stock;
use Carbon\Carbon;
use Livewire\Component;

class ProductRequest extends Component
{

    public ProductHasStock $req;
    public ProductHasStock $new_operation;
    public OperationOut $out;
    protected $paginationTheme = 'bootstrap';
    public $dataHora;

    public function mount()
    {
        $this->req = new ProductHasStock();
        $this->out = new OperationOut();
        $this->dataHora = '';
    }


    public $showSuccesNotification  = false;
    public $showFailureNotification = false;


    protected $rules = [
        'req.product_id' => 'min:1',
        'req.stock_id' => 'min:1',
        'req.quantity' => 'min:1',
        'req.employer_id' => 'min:1',
        'out.description' => 'min:10',
        'dataHora' => 'required|date',
        'out.company_id' => 'min:1'
    ];

    public function save1()
    {

        try {
            $this->validate(); // se falhar, cai no catch

            $product = Product::find($this->req->product_id);

        if ($product && $product->quantity >= $this->req->quantity) {
            // Atualiza estoque
            $this->req->last_qty = $product->quantity;
            $this->updateProduct($product, $this->req->quantity);

            // Cria uma nova operação
            $newOperation = new ProductHasStock();
            $newOperation->product_id = $this->req->product_id;
            $newOperation->quantity = $this->req->quantity;
            $newOperation->last_qty = $this->req->last_qty;
            $newOperation->atual_qty = $product->quantity;
            $newOperation->operation_type = 'O';
            $newOperation->employer_id = $this->req->employer_id;
            $newOperation->stock_id = $this->req->stock_id;
            $newOperation->save();

            // Relaciona com OperationOut
            $newOperation->operation_out_id = $this->saveOperationOut()->id;
            $newOperation->save();

            // Reinicializa os objetos para próxima requisição
            $this->req = new ProductHasStock();
            $this->out = new OperationOut();
            $this->dataHora = '';

                $this->showSuccesNotification = true;
            } else {
                dd('dentro de valid', $this->req, $this->dataHora);

                $this->showFailureNotification = true;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
                dd('dentro de valid', $this->req, $this->dataHora);
            // Aqui você pode tratar os erros
            $this->showFailureNotification = true;
            $this->addError('validation', 'Verifique os campos obrigatórios.');
        }
    }

    public function saveOperationOut()
    {

        $this->out->status = 'out';
        $data = Carbon::parse($this->dataHora)->format('Y-m-d\TH:i');
        return $addStock = OperationOut::create([
            'description' => $this->out->description,
            'initial_time' => $data,
            // 'finish_time' => $this->out->finish_time,
            'status' => $this->out->status,
            'company_id' => $this->out->company_id,
        ]);
    }
    public function updateProduct(Product $product, $new_qty)
    {

        $product->quantity = $product->quantity - $new_qty;
        $product->save();
    }

    public function devolver($reqId)
    {
        $req = ProductHasStock::find($reqId);

        if ($req && $req->operation_type === 'O') {
            $product = Product::find($req->product_id);

            // Atualiza quantidade da ferramenta (devolve ao estoque)
            $product->quantity = $product->quantity + $req->quantity;
            $product->save();

            // Atualiza registro da requisição para marcar como devolvido
            $req->operation_type = 'E'; // "E" de entrada
            $req->atual_qty = $product->quantity;
            $req->save();

            // Cria operação de entrada
            OperationOut::create([
                'description' => 'Devolução do produto: ' . $product->name,
                'initial_time' => now(),
                'status' => 'in',
                'company_id' => $req->stock->company_id ?? null,
            ]);
            $Last_operation_out = OperationOut::find($req->operation_out_id);
            $Last_operation_out->finish_time = now();
            $Last_operation_out->save();
            $this->showSuccesNotification = true;
        } else {
            $this->showFailureNotification = true;
        }
    }

    public function render()
    {

        return view('livewire.product.product-request', [
            'productList' => Product::paginate(10),
            'requestList' => ProductHasStock::orderBy('id', 'DESC')->paginate(10),
            'companyList' => Company::all(),
            'stockList' => Stock::all(),
            'TecnicalList' => Employer::all()
        ]);
    }
}
