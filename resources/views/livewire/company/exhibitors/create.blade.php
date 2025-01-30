<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $exhibitor = [
        'nome' => '',
        'empresa' => '',
        'stand' => '',
        'email' => '',
        'telefone' => '',
    ];

    public function save()
    {
        Validator::make($this->exhibitor, [
            'nome' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'stand' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ])->validate();

        session()->flash('success', 'Expositor salvo com sucesso!');
    }
}; ?>

<div>
    <x-header title="Expositor" separator />

    <x-card>
        <x-input label="Nome" wire:model.defer="exhibitor.nome" required />
        <x-input label="Empresa" wire:model.defer="exhibitor.empresa" required />
        <x-input label="Número do Stand" wire:model.defer="exhibitor.stand" required />
        <x-input label="E-mail" wire:model.defer="exhibitor.email" required />
        <x-input label="Telefone" wire:model.defer="exhibitor.telefone" required />

        <x-button label="Salvar" wire:click="save" primary class="mt-4" />
    </x-card>
</div>
