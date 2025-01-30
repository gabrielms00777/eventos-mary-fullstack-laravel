<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $events;

    public function mount()
    {
        $this->events = [
            [
                'id' => 1,
                'name' => 'Tech Conference 2025',
                'date' => '2025-06-15',
                'location' => 'São Paulo, SP',
                'image' => 'https://placehold.co/400x200',
                'status' => 'upcoming', // Pode ser 'upcoming' ou 'past'
            ],
            [
                'id' => 2,
                'name' => 'Startup Summit',
                'date' => '2024-12-10',
                'location' => 'Rio de Janeiro, RJ',
                'image' => 'https://placehold.co/400x200',
                'status' => 'past',
            ],
        ];
    }
}; ?>

<div>
    <x-header title="Meus Eventos" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refreshDashboard" />
        </x-slot:actions>
    </x-header>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($events as $event)
            <x-card class="mb-4" title="{{ $event['name'] }}"> {{-- Adiciona margem inferior entre os cards --}}
                <img src="{{ $event['image'] }}" alt="Banner do Evento" class="w-full h-40 object-cover rounded-t-lg">
                {{-- Adiciona arredondamento no topo da imagem --}}

                <div class="p-4">
                    <p class="text-gray-600">{{ date('d/m/Y', strtotime($event['date'])) }} - {{ $event['location'] }}
                    </p>

                    <div class="mt-4">
                        @if ($event['status'] === 'upcoming')
                            <x-button primary> {{-- Botão primário --}}
                                Selecionar Evento
                            </x-button>
                        @else
                            <x-button secondary> {{-- Botão secundário --}}
                                Visualizar Evento
                            </x-button>
                        @endif
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</div>
