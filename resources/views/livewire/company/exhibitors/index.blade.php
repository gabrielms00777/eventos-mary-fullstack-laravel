<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'empresa', 'label' => 'Empresa'], ['key' => 'stand', 'label' => 'Número do Stand'], ['key' => 'email', 'label' => 'E-mail'], ['key' => 'telefone', 'label' => 'Telefone', 'sortable' => false]];
    }

    public function exhibitors(): Collection
    {
        return collect([['id' => 1, 'nome' => 'Rodrigo Alves', 'empresa' => 'Future Tech', 'stand' => 'A-12', 'email' => 'rodrigo@futuretech.com', 'telefone' => '(15) 98888-8888'], ['id' => 2, 'nome' => 'Juliana Costa', 'empresa' => 'Inova Mídia', 'stand' => 'B-05', 'email' => 'juliana@inovamidia.com', 'telefone' => '(61) 99999-9999']])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, fn($collection) => $collection->filter(fn($item) => str($item['nome'])->contains($this->search, true)));
    }

    public function with(): array
    {
        return [
            'exhibitors' => $this->exhibitors(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Expositores" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Novo Expositor" :link="route('company.exhibitors.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$exhibitors" :sort-by="$sortBy">
            @scope('actions', $exhibitor)
                <x-button icon="o-pencil" wire:click="edit({{ $exhibitor['id'] }})" spinner
                    class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $exhibitor['id'] }})" wire:confirm="Tem certeza?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>
