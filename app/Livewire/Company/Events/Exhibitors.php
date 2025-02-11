<?php

namespace App\Livewire\Company\Events;

use Livewire\Component;
use App\Models\Exhibitor;
use App\Models\Event;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Expositores do Evento')]
#[Layout('components.layouts.company')]
class Exhibitors extends Component
{
    use Toast, WithPagination;

    public $search;
    public $selected = []; // IDs dos expositores selecionados
    public $event;

    public function mount()
    {
        // Obtém o último evento selecionado pelo usuário
        $user = Auth::user();
        $this->event = Event::find($user->last_event_id);
    }

    public function addSelected()
    {
        // Adiciona os expositores selecionados ao evento
        $this->event->exhibitors()->syncWithoutDetaching($this->selected);
        $this->selected = []; // Limpa a seleção

        $this->toast(
            type: 'success',
            title: 'Expositores adicionados ao evento com sucesso.',
        );
    }

    public function removeFromEvent($exhibitorId)
    {
        // Remove o expositor do evento
        $this->event->exhibitors()->detach($exhibitorId);

        $this->toast(
            type: 'success',
            title: 'Expositor removido do evento com sucesso.',
        );
    }

    public function render()
    {
        $exhibitors = Exhibitor::where('company_id', Auth::user()->company_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.company.events.exhibitors', [
            'exhibitors' => $exhibitors,
            'event' => $this->event,
        ]);
    }
}
