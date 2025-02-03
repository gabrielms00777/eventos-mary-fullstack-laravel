<?php

namespace App\Livewire\Admin\Events;

use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Eventos')]
#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    #[Computed()]
    public function events()
    {
        return Event::query()
            // ->sortBy(...array_values($this->sortBy))
            // ->when($this->search, function ($query) {
            //     return $query->where('nome', 'like', '%' . $this->search . '%');
            // })
            ->select('*')
            ->simplePaginate(3);
    }

    public function eventsRealizados()
    {
        return Event::where('date_end', '<', now())->count();
    }

    public function eventsFuturos()
    {
        return Event::where('date_start', '>=', now())->count();
    }

    public function totalevents()
    {
        return Event::count();
    }


    public function render()
    {
        return view('livewire.admin.events.index', [
            'eventsRealizados' => $this->eventsRealizados(),
            'eventsFuturos' => $this->eventsFuturos(),
            'totalevents' => $this->totalevents(),
        ]);
    }
}
