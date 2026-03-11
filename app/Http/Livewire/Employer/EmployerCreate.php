<?php

namespace App\Http\Livewire\Employer;

use App\Models\Category;
use App\Models\Company;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployerCreate extends Component
{
    use WithFileUploads;

    public Employer $employer;
    public User $user;
    public $stock1 = '';
    public $photo;

    public $showSuccesNotification  = false;
    public $showFailureNotification = false;
    public $showDemoNotification = false;


    public function mount()
    {
        $this->employer = new Employer();
        $this->user = new User();
    }
    public function render()
    {
        $companies = Company::all();
        $categories = Category::all();

        return view('livewire.employer.employer-create', [
            'companies' => $companies,
            'categories' => $categories
        ]);
    }


    protected $rules = [
        'employer.first_name' => 'max:40|min:3',
        'employer.last_name' => 'max:40|min:3',
        'employer.email' => 'email|max:255',
        'employer.identification_type' => 'max:20',
        'employer.identification_num' => 'min:3',
        'employer.adress' => 'max:40',
        'employer.phone1' => 'min:9|max:12',
        'employer.badge_number' => 'min:4',
        'employer.category_id' => 'max:10',
        'employer.company_id' => 'min:1',
        'photo' => 'image|max:1024', // 1MB Max
        'user.password' => 'min:6'

    ];


    public function save()
    {
        try {
            $this->validate();
            // $this->employer->active = 1;
            // $this->employer->photo = $this->photo->store('photos','public/employers');
            $this->employer->save();

            dd($this->employer, $this->user);
            $user = User::create([
                'name' => $this->employer->first_name . ' ' . $this->employer->last_name,
                'email' => $this->employer->email,
                'password' => Hash::make($this->user->password),
                'phone' => $this->employer->phone,
                'location' => 0,
                'photo' => $this->photo->store('photos', 'public/users'),
                'company_id' => $this->employer->company_id,
                'employer_id' => $this->employer->id
            ]);


            $this->showSuccesNotification = true;

            session()->flash('message', 'Employer successfully created.');
            $employer = Employer::paginate(10);
            return redirect()->to('/employers/employer-controll');


            // ...
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Aqui você pode tratar os erros
            $this->showFailureNotification = true;
            $this->addError('validation', 'Verifique os campos obrigatórios.');
            dd($this->employer, $this->user);
            $employer = Employer::paginate(10);
            return view('livewire.employer.employer-controll', [
                "Employers" => $employer
            ]);
        }
    }
}
