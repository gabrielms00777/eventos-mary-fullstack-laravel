<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.employee')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'empresa', 'label' => 'Empresa', 'class' => 'w-64'], ['key' => 'status', 'label' => 'Status']];
    }

    public function visitantes()
    {
        return collect([['id' => 1, 'nome' => 'João Silva', 'empresa' => 'Tech Solutions', 'status' => 'Confirmado'], ['id' => 2, 'nome' => 'Maria Souza', 'empresa' => 'InovaSoft', 'status' => 'Pendente']])
            ->sortBy([array_values($this->sortBy)])
            ->when($this->search, function ($collection) {
                return $collection->filter(fn($item) => str_contains(strtolower($item['nome']), strtolower($this->search)));
            });
    }

    public function with(): array
    {
        return [
            'headers' => $this->headers(),
            'visitantes' => $this->visitantes(),
        ];
    }
}; ?>

<div>
    <x-header title="Visitantes" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$visitantes" :sort-by="$sortBy">
            @scope('actions', $visitante)
                <x-button icon="o-eye" wire:click="visualizarVisitante({{ $visitante['id'] }})" spinner />
                <x-button icon="o-trash" wire:click="excluirVisitante({{ $visitante['id'] }})" wire:confirm="Tem certeza?"
                    spinner class="text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>
