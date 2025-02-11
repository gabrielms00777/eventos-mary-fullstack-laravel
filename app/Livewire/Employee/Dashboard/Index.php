<?php

namespace App\Livewire\Employee\Dashboard;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $events;

    public function mount()
    {
        // Carrega os eventos vinculados ao funcionário
        $this->events = Event::whereHas('employees', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
    }
    
    public function render()
    {
        return view('livewire.employee.dashboard.index');
    }
}
