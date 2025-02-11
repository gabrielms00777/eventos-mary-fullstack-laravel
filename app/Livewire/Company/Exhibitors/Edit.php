<?php

namespace App\Livewire\Company\Exhibitors;

use Livewire\Component;
use App\Livewire\Forms\Company\ExhibitorForm;
use App\Models\Exhibitor;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Editar Expositor')]
#[Layout('components.layouts.company')]
class Edit extends Component
{
    use Toast;

    public ExhibitorForm $form;

    public function mount(Exhibitor $exhibitor)
    {
        $this->form->setExhibitor($exhibitor);
    }

    public function update()
    {
        $this->form->update();

        $this->toast(
            type: 'success',
            title: 'Expositor atualizado com sucesso!',
            redirectTo: route('company.exhibitors.index'),
        );
    }

    public function render()
    {
        return view('livewire.company.exhibitors.edit');
    }
}
