<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $company = [
        'nome' => 'Tech Solutions',
        'email' => 'contato@techsolutions.com',
        'telefone' => '(11) 98765-4321',
        'endereco' => 'Av. Paulista, 1000 - São Paulo, SP',
        'cnpj' => '12.345.678/0001-99',
    ];

    public function save()
    {
        Validator::make($this->company, [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:18',
        ])->validate();

        session()->flash('success', 'Perfil atualizado com sucesso!');
    }
}; ?>

<div>
    <x-header title="{{ __('company.profile') }}" separator /> {{-- Título internacionalizado --}}

    <x-card>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> {{-- Layout em grid responsivo --}}
            <x-input label="{{ __('company.name') }}" wire:model="company.name" required />
            <x-input label="{{ __('company.email') }}" wire:model="company.email" required type="email" />
            {{-- Adicionado tipo email --}}
            <x-input label="{{ __('company.phone') }}" wire:model="company.phone" required /> {{-- Campo de telefone --}}
            <x-input label="{{ __('company.address') }}" wire:model="company.address" />
            <x-input label="{{ __('company.cnpj') }}" wire:model="company.cnpj" required />
        </div>

        <div class="mt-4 flex justify-end"> {{-- Alinha os botões à direita --}}
            <x-button label="{{ __('company.save') }}" wire:click="save" primary />
            <x-button label="{{ __('company.back') }}" wire:click="back" secondary class="ml-2" />
            {{-- Botão de voltar --}}
        </div>
    </x-card>
</div>
