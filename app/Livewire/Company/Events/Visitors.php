<?php

namespace App\Livewire\Company\Events;

use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Title('Visitantes do evento')]
#[Layout('components.layouts.company')]
class Visitors extends Component
{
    use Toast, WithPagination;

    public $search;
    public $selected = []; 
    public $event;

    public function mount()
    {
        $this->event = Event::find(Auth::user()->last_event_id);
    }

    public function addSelected()
    {
        // Adiciona os visitantes selecionados ao evento
        $this->event->visitors()->syncWithoutDetaching($this->selected);
        $this->selected = []; // Limpa a seleção

        $this->toast(
            type: 'success',
            title: 'Visitantes adicionados ao evento com sucesso.',
        );
    }

    public function removeFromEvent($visitorId)
    {
        // Remove o visitante do evento
        $this->event->visitors()->detach($visitorId);

        $this->toast(
            type: 'success',
            title: 'Visitante removido do evento com sucesso.',
        );
    }

    #[Computed(persist: true)]
    public function visitors()
    {
        return Visitor::query()
        ->where('company_id', Auth::user()->company_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.company.events.visitors');
    }
}
