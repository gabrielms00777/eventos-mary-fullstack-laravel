<?php

namespace App\Livewire\Company\Visitors;

use App\Livewire\Forms\Company\VisitorForm;
use App\Models\Visitor;
use Livewire\Component;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Editar Visitante')]
#[Layout('components.layouts.company')]
class Edit extends Component
{
    use Toast;

    public VisitorForm $form;

    public function mount(Visitor $visitor)
    {
        $this->form->setVisitor($visitor);
    }

    public function update()
    {
        $this->form->update();

        $this->toast(
            type: 'success',
            title: 'Visitante atualizado com sucesso!',
            redirectTo: route('company.visitors.index'),
        );
    }

    public function render()
    {
        return view('livewire.company.visitors.edit');
    }
}
