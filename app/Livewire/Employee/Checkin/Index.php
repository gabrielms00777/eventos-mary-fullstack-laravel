<?php

namespace App\Livewire\Employee\Checkin;

use Livewire\Component;
use App\Models\Visitor;
use App\Models\Exhibitor;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search;
    public $event;
    public $visitors;
    public $exhibitors;

    public function mount()
    {
        $this->event = Event::whereHas('employees', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->first();

        if ($this->event) {
            $this->visitors = $this->event->visitors;
            $this->exhibitors = $this->event->exhibitors;
        }
    }

    public function checkInVisitor($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        $visitor->update(['checked_in_at' => now()]);

        session()->flash('message', 'Check-in do visitante realizado com sucesso!');
    }

    public function checkInExhibitor($exhibitorId)
    {
        $exhibitor = Exhibitor::find($exhibitorId);
        $exhibitor->update(['checked_in_at' => now()]);

        session()->flash('message', 'Check-in do expositor realizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.employee.checkin.index');
    }
}
