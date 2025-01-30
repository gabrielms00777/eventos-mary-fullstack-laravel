<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.employee')] #[Title('Dashboard')] class extends Component {
    //
}; ?>

<div>
    <x-header title="Eventos" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$eventos" :sort-by="$sortBy">
            @scope('actions', $evento)
                @if (!$evento['concluido'])
                    <x-button label="Selecionar" wire:click="selecionarEvento({{ $evento['id'] }})" primary />
                @else
                    <x-button label="Visualizar" wire:click="visualizarEvento({{ $evento['id'] }})" />
                @endif
            @endscope
        </x-table>
    </x-card>
</div>
