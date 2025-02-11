<?php

namespace App\Livewire\Company\Dashboard;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\EmployeeTypeEnum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    public ?Event $event = null;
    public $daysLeft;
    public $registeredVisitors;
    public $totalVisitors;
    public $totalStaff;
    public $completedTasks;
    public $totalTasks;

    public function mount()
    {
        $this->event = Event::find(Auth::user()->last_event_id);
        $this->calculateMetrics();
    }

    public function refreshDashboard()
    {
        $this->calculateMetrics();
    }

    public function calculateMetrics()
    {
        $this->daysLeft = Carbon::parse($this->event->start_date)->diffInDays();
        $this->registeredVisitors = $this->event->registrations()->count();
        $this->totalVisitors = $this->event->max_participants;
        $this->totalStaff = $this->event->company->employees()->where('role', EmployeeTypeEnum::STAFF)->count();
        // $this->totalStaff = $this->event->company();
        $this->completedTasks = $this->event->registrations()->where('status', 'confirmed')->count();
        $this->totalTasks = $this->event->registrations()->count();
    }

    public function render()
    {
        return view('livewire.company.dashboard.index');
    }


}
