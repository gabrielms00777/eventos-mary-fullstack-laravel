<?php

namespace App\Livewire\Admin\Companies;

use App\Livewire\Forms\Admin\CompanyForm;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;

#[Layout('components.layouts.admin')] #[Title('Cadastro Empresa')]
class Create extends Component
{
    use Toast;

    public CompanyForm $form;

    public function save()
    {
        $this->form->store();

        $this->toast(
            type: 'success',
            title: 'Empresa cadastrada com sucesso!!!',
            redirectTo: route('admin.companies.index')
        );
    }

    public function render()
    {
        return view('livewire.admin.companies.create');
    }
}
