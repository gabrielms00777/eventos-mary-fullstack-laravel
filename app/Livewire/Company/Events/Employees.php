<?php

namespace App\Livewire\Company\Events;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;
use Livewire\WithPagination;

#[Title('Funcionários do Evento')]
#[Layout('components.layouts.company')]
class Employees extends Component
{
    use Toast, WithPagination;

    public $search = '';
    // public ?Event $event = null;
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];
    public $selected = [];
    public $headers = [
            ['key' => 'user.name', 'label' => 'Nome'],
            ['key' => 'user.email', 'label' => 'E-mail'],
            ['key' => 'position', 'label' => 'Posição'],
            ['key' => 'role', 'label' => 'Cargo'],
            ['key' => 'is_linked', 'label' => 'Incluído'],
            ['key' => 'actions', 'label' => 'Ações', 'class' => 'text-right'],
    ];

    public function mount()
    {
        // $this->event = Event::find(Auth::user()->last_event_id);
    }

    #[Computed()]
    public function event()
    {
        return Event::find(Auth::user()->last_event_id);
    }
    public function removeAll()
    {
        $this->event->employees()->detach();
        $this->selected = [];

        $this->toast(
            type: 'success',
            title: 'Todos os funcionários foram removidos do evento.',
        );
    }

    public function addSelected()
    {
        $this->event->employees()->syncWithoutDetaching($this->selected);

        $this->toast(
            type: 'success',
            title: 'Funcionários selecionados foram adicionados ao evento.',
        );
    }

    public function removeSelected()
    {
        $this->event->employees()->detach($this->selected);
        $this->selected = [];

        $this->toast(
            type: 'success',
            title: 'Funcionários selecionados foram removidos do evento.',
        );
    }


    public function selectAll()
    {
        $this->selected = $this->employees->pluck('id')->toArray();
    }

    public function addToEvent(Employee $employee)
    {
        $this->event->employees()->syncWithoutDetaching($employee);

        $this->toast(
            type: 'success',
            title: 'Funcionário adicionado com sucesso!',
        );
    }

    public function addAllToEvent()
    {
        $employees = Employee::query()
            ->where('company_id', $this->event->company_id)
            ->get();

        foreach ($employees as $employee) {
            $this->event->employees()->syncWithoutDetaching($employee);
        }

        $this->toast(
            type: 'success',
            title: 'Funcionários adicionados com sucesso!',
        );
    }

    public function removeFromEvent(Employee $employee)
    {
        $this->event->employees()->detach($employee);

        $this->toast(
            type: 'success',
            title: 'Funcionário removido com sucesso!',
        );
    }

    public function removeAllFromEvent()
    {
        $this->event->employees()->detach();

        $this->toast(
            type: 'success',
            title: 'Funcionários removidos com sucesso!',
        );
    }

    #[Computed()]
    public function employees()
    {
        return Employee::query()
            ->select(['id', 'position', 'company_id', 'user_id','role'])
            ->with('user:id,name,email,role')
            ->where('company_id', $this->event->company_id)
            ->where('user_id', '!=', Auth::id())
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.company.events.employees');
    }
}
