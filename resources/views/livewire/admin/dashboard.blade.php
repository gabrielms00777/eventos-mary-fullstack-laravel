<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'date', 'direction' => 'desc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'name', 'label' => 'Evento', 'class' => 'w-64'], ['key' => 'company', 'label' => 'Empresa', 'class' => 'w-40'], ['key' => 'date', 'label' => 'Data', 'class' => 'w-32'], ['key' => 'status', 'label' => 'Status', 'class' => 'w-20']];
    }

    public function events(): Collection
    {
        return collect([['id' => 1, 'name' => 'Tech Summit', 'company' => 'ABC Tech', 'date' => '2024-06-15', 'status' => 'Ativo'], ['id' => 2, 'name' => 'Marketing Expo', 'company' => 'XYZ Marketing', 'date' => '2024-07-01', 'status' => 'Pendente'], ['id' => 3, 'name' => 'Finance Meetup', 'company' => 'Finance Inc.', 'date' => '2024-08-20', 'status' => 'Finalizado']])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn($event) => str($event['name'])->contains($this->search, true));
            });
    }

    public function with(): array
    {
        return [
            'events' => $this->events(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Dashboard" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar eventos..." wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <!-- ESTATÍSTICAS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stat value="150" title="Eventos Criados" icon="o-calendar" />
        <x-stat value="200" title="Empresas Cadastradas" icon="o-calendar" />
        <x-stat value="12" title="Eventos Ativos" icon="o-check-circle" />
        <x-stat value="3000+" title="Visitantes Registrados" icon="o-users" />
    </div>

    <!-- TABELA DE EVENTOS RECENTES -->
    <x-card class="mt-6">
        <x-table :headers="$headers" :rows="$events" :sort-by="$sortBy">
            @scope('actions', $event)
                <x-button icon="o-pencil" class="btn-ghost btn-sm" wire:click="edit({{ $event['id'] }})" />
                <x-button icon="o-trash" class="btn-ghost btn-sm text-red-500" wire:click="delete({{ $event['id'] }})"
                    wire:confirm="Tem certeza?" spinner />
            @endscope
        </x-table>
    </x-card>

</div>
