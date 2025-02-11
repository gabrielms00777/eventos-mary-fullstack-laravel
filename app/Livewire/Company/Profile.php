<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Perfil da Empresa')]
#[Layout('components.layouts.company')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.company.profile');
    }
}
