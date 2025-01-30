<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $employee = [
        'nome' => '',
        'cargo' => '',
        'email' => '',
        'telefone' => '',
    ];

    public function save()
    {
        Validator::make($this->employee, [
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ])->validate();

        session()->flash('success', 'Funcionário salvo com sucesso!');
    }
}; ?>

<div>
    <x-header title="Funcionário" separator />

    <x-card>
        <x-input label="Nome" wire:model.defer="employee.nome" required />
        <x-input label="Cargo" wire:model.defer="employee.cargo" required />
        <x-input label="E-mail" wire:model.defer="employee.email" required />
        <x-input label="Telefone" wire:model.defer="employee.telefone" required />

        <x-button label="Salvar" wire:click="save" primary class="mt-4" />
    </x-card>
</div>
