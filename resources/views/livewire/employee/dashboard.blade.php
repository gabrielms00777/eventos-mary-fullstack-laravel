<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.employee')] #[Title('Dashboard')] class extends Component {
    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'nome', 'label' => 'Nome', 'class' => 'w-64'], ['key' => 'data', 'label' => 'Data', 'class' => 'w-64'], ['key' => 'status', 'label' => 'Status']];
    }

    public function eventos()
    {
        return collect([['id' => 1, 'nome' => 'Tech Conference 2025', 'data' => '2025-06-15', 'status' => 'Ativo'], ['id' => 2, 'nome' => 'Expo Inovação', 'data' => '2025-07-20', 'status' => 'Ativo']])
            ->sortBy([array_values($this->sortBy)])
            ->when($this->search, function ($collection) {
                return $collection->filter(fn($item) => str_contains(strtolower($item['nome']), strtolower($this->search)));
            });
    }

    public function with(): array
    {
        return [
            'headers' => $this->headers(),
            'eventos' => $this->eventos(),
            'eventosInscritos' => '10',
            'eventosConcluidos' => '10',
            'proximosEventos' => '10',
        ];
    }
}; ?>

<div>
    <x-header title="Dashboard" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refresh" spinner />
        </x-slot:actions>
    </x-header>

    <x-card>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card class="shadow-md" title="Eventos Inscritos">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $eventosInscritos }}
                </div>
            </x-card>

            <x-card class="shadow-md" title="Eventos Concluídos">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $eventosConcluidos }}
                </div>
            </x-card>

            <x-card class="shadow-md" title="Próximos Eventos">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $proximosEventos }}
                </div>
            </x-card>
        </div>
    </x-card>
</div>
