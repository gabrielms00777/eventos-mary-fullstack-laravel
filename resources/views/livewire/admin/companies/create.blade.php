<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Cadastro Empresa')] class extends Component {
    public $empresa = [
        'nome' => '',
        'cnpj' => '',
        'email' => '',
        'telefone' => '',
        'endereco' => [
            'rua' => '',
            'numero' => '',
            'cidade' => '',
            'estado' => '',
        ],
    ];

    public function salvarEmpresa()
    {
        $this->validate([
            'empresa.nome' => 'required|string|min:3',
            'empresa.cnpj' => 'required|string|size:18',
            'empresa.email' => 'required|email',
            'empresa.telefone' => 'nullable|string',
            'empresa.endereco.rua' => 'required|string',
            'empresa.endereco.numero' => 'required|string',
            'empresa.endereco.cidade' => 'required|string',
            'empresa.endereco.estado' => 'required|string',
        ]);

        // Simula salvamento no banco
        session()->flash('success', 'Empresa cadastrada com sucesso!');
        $this->reset('empresa');
    }
}; ?>

<div>
    <x-header title="Criar Empresa" separator />

    <x-card>
        <form wire:submit.prevent="salvarEmpresa">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Nome da Empresa" wire:model.defer="empresa.nome" required />
                <x-input label="CNPJ" wire:model.defer="empresa.cnpj" mask="##.###.###/####-##" required />
                <x-input label="E-mail" type="email" wire:model.defer="empresa.email" required />
                <x-input label="Telefone" wire:model.defer="empresa.telefone" mask="(##) #####-####" />
            </div>


            <x-header title="Endereço" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Rua" wire:model.defer="empresa.endereco.rua" required />
                <x-input label="Número" wire:model.defer="empresa.endereco.numero" required />
                <x-input label="Cidade" wire:model.defer="empresa.endereco.cidade" required />
                <x-input label="Estado" wire:model.defer="empresa.endereco.estado" required />
            </div>


            <x-button label="Salvar Empresa" icon="o-check" primary spinner wire:click="salvarEmpresa" class="mt-4" />
        </form>
    </x-card>

</div>
