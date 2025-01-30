<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $visitor = [
        'nome' => '',
        'empresa' => '',
        'email' => '',
        'telefone' => '',
    ];

    public function save()
    {
        Validator::make($this->visitor, [
            'nome' => 'required|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ])->validate();

        session()->flash('success', 'Visitante salvo com sucesso!');
    }
}; ?>

<div>
    <x-header title="Visitante" separator />

    <x-card>
        <x-input label="Nome" wire:model.defer="visitor.nome" required />
        <x-input label="Empresa" wire:model.defer="visitor.empresa" />
        <x-input label="E-mail" wire:model.defer="visitor.email" required />
        <x-input label="Telefone" wire:model.defer="visitor.telefone" required />

        <x-button label="Salvar" wire:click="save" primary class="mt-4" />
    </x-card>
</div>
