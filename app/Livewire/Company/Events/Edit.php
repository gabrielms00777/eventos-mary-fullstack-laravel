<?php

namespace App\Livewire\Company\Events;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Editar Evento')]
#[Layout('components.layouts.company')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.company.events.edit');
    }
}
