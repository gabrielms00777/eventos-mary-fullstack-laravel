<?php

namespace App\Livewire\Company\Employees;

use App\Models\Employee;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;

#[Title('Funcionários')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    use Toast;

    public $search = '';
    public ?Event $event = null;
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];
    public $selected = [];
    public $headers = [
            ['key' => 'name', 'label' => 'Nome'],
            ['key' => 'email', 'label' => 'E-mail'],
            ['key' => 'role', 'label' => 'Cargo'],
            ['key' => 'actions', 'label' => 'Ações'],
    ];

    public function mount()
    {
        $this->event = Event::find(Auth::user()->last_event_id);
    }

    public function addEmployee(Employee $employee)
    {
        $this->event->employees()->syncWithoutDetaching($employee);

        $this->toast(
            type: 'success',
            title: 'Funcionário adicionado com sucesso!',
            // redirectTo: route('company.employees.index')
        );
    }

    public function addAllEmployees()
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
            // redirectTo: route('company.employees.index')
        );
    }

    public function removeEmployee(Employee $employee)
    {
        $this->event->employees()->detach($employee);

        $this->toast(
            type: 'success',
            title: 'Funcionário removido com sucesso!',
            // redirectTo: route('company.employees.index')
        );
    }

    public function removeAllEmployees()
    {
        $this->event->employees()->detach();

        $this->toast(
            type: 'success',
            title: 'Funcionários removidos com sucesso!',
            // redirectTo: route('company.employees.index')
        );
    }

    public function save()
    {
        $this->event->employees()->sync($this->selected);

        $this->toast(
            type: 'success',
            title: 'Funcionários adicionados com sucesso!',
            // redirectTo: route('company.employees.index')
        );  
    }

    #[Computed()]
    public function employees()
    {
        return Employee::query()
            ->where('company_id', $this->event->company_id)
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->get();
    }

    public function render()
    {
        return view('livewire.company.employees.index',[
            'event' => $this->event,
        ]);
    }
}
