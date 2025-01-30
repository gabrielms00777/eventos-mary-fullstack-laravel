<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Empresas')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'cnpj', 'label' => 'CNPJ', 'class' => 'w-64'], ['key' => 'email', 'label' => 'E-mail'], ['key' => 'telefone', 'label' => 'Telefone', 'sortable' => false]];
    }

    public function companies(): Collection
    {
        return collect([['id' => 1, 'nome' => 'Tech Solutions', 'cnpj' => '12.345.678/0001-99', 'email' => 'contato@tech.com', 'telefone' => '(11) 99999-9999'], ['id' => 2, 'nome' => 'InovaSoft', 'cnpj' => '98.765.432/0001-55', 'email' => 'suporte@inova.com', 'telefone' => '(21) 98888-8888']])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['nome'])->contains($this->search, true));
            });
    }
    public function with(): array
    {
        return [
            'companies' => $this->companies(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Empresas" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Nova Empresa" :link="route('admin.companies.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$companies" :sort-by="$sortBy">
            @scope('actions', $company)
                <x-button icon="o-pencil" wire:click="edit({{ $company['id'] }})" spinner
                    class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $company['id'] }})" wire:confirm="Tem certeza?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

</div>
