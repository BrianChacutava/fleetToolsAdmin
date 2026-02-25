<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Companies\CompanyEdit;
use App\Http\Livewire\Companies\CreateCompany;
use App\Http\Livewire\Companies\EditCompany;
use App\Http\Livewire\CompaniesManager;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Employer\EmployerControll;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\Product\ProductControll;
use App\Http\Livewire\Product\ProductCreate;
use App\Http\Livewire\Product\ProductGroupControll;
use App\Http\Livewire\Product\ProductGroupCreate;
use App\Http\Livewire\Product\ProductReport;
use App\Http\Livewire\Product\ProductRequest;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Rtl;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Stock\StockControler;
use App\Http\Livewire\Tables;
use App\Http\Livewire\Tools\CreateTool;
use App\Http\Livewire\Tools\ToolControll;
use App\Http\Livewire\Tools\ToolGroupForm;
use App\Http\Livewire\Tools\ToolReport;
use App\Http\Livewire\Tools\ToolRequest;
use App\Http\Livewire\Tools\ToolTable;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');


    Route::get('/tools/tool-controll', ToolControll::class)->name('tool-list');
    Route::get('/tools/tool-group', \App\Http\Livewire\Tools\ToolGroupControll::class)->name('Tool-Group');
    Route::get('/tools/tool-group-create', ToolGroupForm::class)->name('Tool-Group.create');
    Route::get('/tools/tool-group/{id}/edit', \App\Http\Livewire\Tools\ToolGroupForm::class)->name('Tool-Group.edit');
    Route::get('/tools/create-tool', CreateTool::class)->name('tool-create');
    Route::get('/tools/Tool-Table', ToolTable::class)->name('Tool-Table');
    Route::get('/tools/Tool-Request', ToolRequest::class)->name('Tool-Request');
    Route::get('/tools/tool-report', ToolReport::class)->name('tool.report');

    Route::get('/product/product-controll', ProductControll::class)->name('product-list');
    Route::get('/product/product-create', ProductCreate::class)->name('product-create');
    Route::get('/product/product-group', ProductGroupControll::class)->name('Product-Group');
    Route::get('/product/product-group-create', ProductGroupCreate::class)->name('Product-Group.create');
    Route::get('/product/product-request', ProductRequest::class)->name('Product-Request');
    Route::get('/product/product-report', ProductReport::class)->name('product.report');


    Route::get('/stock/stock-controler', StockControler::class)->name('stock-list');
    Route::get('/companies', CompaniesManager::class)->name('companies.index');
    Route::get('/companies/create', CreateCompany::class)->name('companies.create');
    // Backwards-compatible redirect for old URL format '/companies/edit/{company}' → '/companies/{id}/edit'
    Route::get('/companies/edit/{id}', function ($id) {
        return redirect()->route('companies.edit', $id);
    })->name('companies.edit.legacy');

    Route::get('/companies/edit', EditCompany::class)->name('companies.edit');
    Route::get('/companies/delete/{id}', [EditCompany::class, 'delete'])->name('companies.delete');
    // Route::get('/companies/edit', CompanyEdit::class)->name('companies.edit');

    Route::get('/employer/employer-controll', EmployerControll::class)->name('employer-list');

});
