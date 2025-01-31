<?php

namespace App\Livewire\Admin\Companies;

use App\Livewire\Forms\Admin\CompanyForm;
use App\Models\Company;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;

    public Company $company;
    public CompanyForm $form;

    public function mount(Company $company)
    {
        $this->form->setCompany($company);
    }

    public function save()
    {
        $this->form->update();

        $this->toast(
            type: 'success',
            title: 'Empresa atualiza com sucesso!!!',
            redirectTo: route('admin.companies.index')
        );
    }

    public function render()
    {
        return view('livewire.admin.companies.edit');
    }
}
