<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.company')] #[Title('Dashboard')] class extends Component {
    public $eventData;

    public function mount()
    {
        $this->eventData = [
            'name' => 'Tech Conference 2025',
            'image' => 'https://placehold.co/600x300',
            'daysLeft' => 15,
            'registeredVisitors' => 320,
            'totalVisitors' => 500,
            'totalStaff' => 20,
            'completedTasks' => 30,
            'totalTasks' => 50,
        ];
    }
}; ?>

<div>
    <x-header title="Dashboard - {{ $eventData['name'] }}" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refreshDashboard" />
        </x-slot:actions>
    </x-header>

    <div class="space-y-8">
        <div class="relative">
            <img src="{{ $eventData['image'] }}" alt="Event Banner"
                class="w-full h-64 rounded-lg shadow-lg object-cover" />
            <div class="absolute bottom-4 left-4 bg-black bg-opacity-60 text-white p-4 rounded-lg">
                <h2 class="text-xl font-semibold">{{ $eventData['name'] }}</h2>
                <p class="text-sm">Faltam {{ $eventData['daysLeft'] }} dias para o evento</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-card title="Dias Restantes">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $eventData['daysLeft'] }}
                </div>
            </x-card>

            <x-card title="Visitantes Inscritos">
                <div>
                    <p class="text-4xl font-bold text-gray-700">
                        {{ $eventData['registeredVisitors'] }} / {{ $eventData['totalVisitors'] }}
                    </p>
                    <x-progress value="{{ ($eventData['registeredVisitors'] / $eventData['totalVisitors']) * 100 }}" />
                </div>
            </x-card>

            <x-card title="Equipe">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $eventData['totalStaff'] }}
                </div>
            </x-card>

            <x-card title="Tarefas Concluídas">
                <div>
                    <p class="text-4xl font-bold text-gray-700">
                        {{ $eventData['completedTasks'] }} / {{ $eventData['totalTasks'] }}
                    </p>
                    <x-progress value="{{ ($eventData['completedTasks'] / $eventData['totalTasks']) * 100 }}" />
                </div>
            </x-card>
        </div>
    </div>
</div>
