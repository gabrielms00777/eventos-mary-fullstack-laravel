<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyForm extends Form
{
    public ?Company $company;

    #[Validate(['requered', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['requered', 'email', 'max:255'])]
    public ?string $email = null;

    #[Validate(['requered', 'string', 'max:255'])]
    public ?string $cnpj = null;

    #[Validate(['requered', 'string', 'max:255'])]
    public ?string $phone = null;

    #[Validate(['requered', 'string', 'max:255'])]
    public ?string $address = null;

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
        $this->validate();

        Company::create($this->only([
            'name',
            'email',
            'cnpj',
            'phone',
            'address',
        ]));
    }

    public function update()
    {
        $this->validate();

        $this->company->update($this->all());
    }
}
