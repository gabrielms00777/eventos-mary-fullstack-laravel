<?php

namespace App\Livewire\Employee\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; 

    public $search;

    public function render()
    {
        $events = Event::whereHas('employees', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('start_date')
        ->paginate(10);

        return view('livewire.employee.events.index', [
            'events' => $events,
        ]);
    }
}
