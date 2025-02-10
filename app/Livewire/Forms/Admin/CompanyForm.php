<?php

namespace App\Livewire\Forms\Admin;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Notifications\WelcomeOwnerNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;
use \Illuminate\Support\Str;

class CompanyForm extends Form
{
    public ?Company $company = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'email', 'max:255'])]
    public ?string $email = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $cnpj = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $phone = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $address = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $responsible_name = null;

    #[Validate(['required', 'email', 'max:255', 'unique:users,email'])]
    public ?string $responsible_email = null;

    public function setCompany(Company $company)
    {
        $this->company = $company;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->cnpj = $company->cnpj;
        $this->phone = $company->phone;
        $this->address = $company->address;
    }

    public function store()
    {
        DB::beginTransaction();

        // try {
            $company = Company::create($this->validate());

            $user = User::create([
                'name' => $this->responsible_name,
                'email' => $this->responsible_email,
                'password' => Hash::make(Str::random(10)),
                'role' => UserTypeEnum::MANAGER,
                'company_id' => $company->id,
            ]);

            Employee::create([
                'user_id' => $user->id,
                'company_id' => $company->id,
                'role' => 'admin',
            ]);

            DB::commit();

            return;
        // } catch (\Exception $e) {
        //     Log::error('Erro ao cadastrar empresa: ' . $e->getMessage());

        //     DB::rollBack();

        //     throw $e;
        // }
    }

    public function update()
    {
        $this->validate();

        $this->company->update($this->all());
    }
}
