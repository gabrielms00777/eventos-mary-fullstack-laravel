<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'empresa', 'label' => 'Empresa'], ['key' => 'email', 'label' => 'E-mail'], ['key' => 'telefone', 'label' => 'Telefone', 'sortable' => false]];
    }

    public function visitors(): Collection
    {
        return collect([['id' => 1, 'nome' => 'Carlos Mendes', 'empresa' => 'Tech Innovations', 'email' => 'carlos@tech.com', 'telefone' => '(31) 95555-5555'], ['id' => 2, 'nome' => 'Ana Lima', 'empresa' => 'Startup Hub', 'email' => 'ana@hub.com', 'telefone' => '(47) 97777-7777']])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, fn($collection) => $collection->filter(fn($item) => str($item['nome'])->contains($this->search, true)));
    }

    public function with(): array
    {
        return [
            'visitors' => $this->visitors(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Visitantes" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Novo Visitante" :link="route('company.visitors.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$visitors" :sort-by="$sortBy">
            @scope('actions', $visitor)
                <x-button icon="o-pencil" wire:click="edit({{ $visitor['id'] }})" spinner
                    class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $visitor['id'] })" wire:confirm="Tem certeza?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>
