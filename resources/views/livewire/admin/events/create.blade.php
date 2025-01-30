<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Cadastro Evento')] class extends Component {
    public $evento = [
        'titulo' => '',
        'data' => '',
        'local' => '',
        'capacidade' => '',
        'descricao' => '',
    ];

    public $imagem;

    public function salvarEvento()
    {
        $this->validate([
            'evento.titulo' => 'required|string|min:3',
            'evento.data' => 'required|date',
            'evento.local' => 'required|string',
            'evento.capacidade' => 'required|integer|min:1',
            'evento.descricao' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
        ]);

        // Simula salvamento no banco
        session()->flash('success', 'Evento cadastrado com sucesso!');
        $this->reset('evento', 'imagem');
    }
}; ?>

<div>
    <x-header title="Criar Evento" separator />

    <x-card>
        <form wire:submit.prevent="salvarEvento">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Título do Evento" wire:model.defer="evento.titulo" required />
                <x-input label="Data do Evento" type="date" wire:model.defer="evento.data" required />
                <x-input label="Local" wire:model.defer="evento.local" required />
                <x-input label="Capacidade Máxima" type="number" wire:model.defer="evento.capacidade" required />
            </div>


            <x-header title="Descrição" />
            <x-textarea label="Descrição do Evento" wire:model.defer="evento.descricao" required />


            <x-header title="Imagem do Evento" />
            <x-input label="Imagem" type="file" wire:model="imagem" accept="image/*" />

            <x-button label="Salvar Evento" icon="o-check" primary spinner wire:click="salvarEvento" class="mt-4" />
        </form>
    </x-card>

</div>
