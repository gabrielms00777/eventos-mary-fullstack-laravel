<?php

namespace App\Livewire\Company\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    #[Computed()]
    public function events()
    {
        return Event::query()
            ->where('company_id', Auth::user()->company_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.company.events.index');
    }
}
