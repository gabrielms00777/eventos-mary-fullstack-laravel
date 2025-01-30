<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'cargo', 'label' => 'Cargo'], ['key' => 'email', 'label' => 'E-mail'], ['key' => 'telefone', 'label' => 'Telefone', 'sortable' => false]];
    }

    public function employees(): Collection
    {
        return collect([['id' => 1, 'nome' => 'Lucas Silva', 'cargo' => 'Coordenador', 'email' => 'lucas@empresa.com', 'telefone' => '(11) 99999-9999'], ['id' => 2, 'nome' => 'Maria Santos', 'cargo' => 'Recepcionista', 'email' => 'maria@empresa.com', 'telefone' => '(21) 98888-8888']])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, fn($collection) => $collection->filter(fn($item) => str($item['nome'])->contains($this->search, true)));
    }

    public function with(): array
    {
        return [
            'employees' => $this->employees(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Funcionários" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Novo Funcionário" :link="route('company.employees.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$employees" :sort-by="$sortBy">
            @scope('actions', $employee)
                <x-button icon="o-pencil" wire:click="edit({{ $employee['id'] }})" spinner
                    class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $employee['id'] }})" wire:confirm="Tem certeza?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>
