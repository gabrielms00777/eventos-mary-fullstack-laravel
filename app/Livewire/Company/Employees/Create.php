<?php

namespace App\Livewire\Company\Employees;

use App\Livewire\Forms\Company\EmployeeForm;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;

#[Title('Cadastrar Funcionário')]
#[Layout('components.layouts.company')]
class Create extends Component
{
    use Toast;

    public EmployeeForm $form;

    public function save()
    {
        try {
            $this->form->store();

            $this->toast(
                type: 'success',
                title: 'Funcionário cadastrado com sucesso!',
                redirectTo: route('company.employees.index')
            );
        } catch (\Exception $e) {
            $this->toast(
                type: 'error',
                title: 'Erro ao cadastrar funcionário!',
                description: $e->getMessage()
            );
        }
    }
    
    public function render()
    {
        return view('livewire.company.employees.create');
    }
}
