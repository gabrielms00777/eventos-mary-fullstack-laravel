<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Eventos')] class extends Component {
    public function eventos(): Collection
    {
        return collect([['id' => 1, 'titulo' => 'Tech Conference 2024', 'data' => '2024-03-15', 'local' => 'São Paulo, SP', 'descricao' => 'Um evento sobre tecnologia e inovação.', 'imagem' => 'https://source.unsplash.com/300x200/?technology'], ['id' => 2, 'titulo' => 'Workshop Laravel', 'data' => '2024-04-10', 'local' => 'Online', 'descricao' => 'Aprenda Laravel com os melhores profissionais.', 'imagem' => 'https://source.unsplash.com/300x200/?code'], ['id' => 3, 'titulo' => 'Empreendedorismo Digital', 'data' => '2024-05-05', 'local' => 'Rio de Janeiro, RJ', 'descricao' => 'Evento para quem quer começar um negócio online.', 'imagem' => 'https://source.unsplash.com/300x200/?business']]);
    }

    public function eventosRealizados()
    {
        return $this->eventos()->where('data', '<', now())->count();
    }

    public function eventosFuturos()
    {
        return $this->eventos()->where('data', '>=', now())->count();
    }

    public function totalEventos()
    {
        return $this->eventos()->count();
    }
    public function with(): array
    {
        return [
            'eventos' => $this->eventos(),
            'eventosRealizados' => $this->eventosRealizados(),
            'eventosFuturos' => $this->eventosFuturos(),
            'totalEventos' => $this->totalEventos(),
        ];
    }
}; ?>

<div>
    <x-header title="Eventos" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Novo Evento" :link="route('admin.events.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-stat label="Eventos Realizados" icon="o-check-circle" :value="$eventosRealizados" />
        <x-stat label="Próximos Eventos" icon="o-clock" :value="$eventosFuturos" />
        <x-stat label="Total de Eventos" icon="o-calendar-days" :value="$totalEventos" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach ($eventos as $evento)
            <x-card class="p-4">
                <img src="{{ $evento['imagem'] }}" class="w-full h-40 object-cover rounded-lg" />
                <h2 class="text-lg font-bold mt-4">{{ $evento['titulo'] }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ $evento['data'] }} - {{ $evento['local'] }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($evento['descricao'], 100) }}</p>
                <x-button label="Ver Evento" wire:click="verEvento({{ $evento['id'] }})" class="mt-4 w-full" primary />
            </x-card>
        @endforeach
    </div>

</div>
