<?php

namespace App\Livewire\Admin\Events;

use App\Livewire\Forms\Admin\EventForm;
use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Cadastro de Evento')]
class Create extends Component
{
    use Toast, WithFileUploads;

    public EventForm $form;

    public $companies;

    public function mount()
    {
        $this->companies = Company::all(['id', 'name']);
    }

    public function save()
    {
        try {
            $this->form->store();
    
            $this->toast(
                type: 'success',
                title: 'Evento cadastrado com sucesso!',
                redirectTo: route('admin.events.index') 
            );
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->toast(
                type: 'error',
                title: 'Erro ao cadastrar evento!',
                description: $e->getMessage()
            );
        }
    }
    public function render()
    {
        return view('livewire.admin.events.create');
    }
}
