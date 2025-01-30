<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] #[Title('Relatorios')] class extends Component {
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];
    public $search = '';
    public function eventos(): Collection
    {
        return collect([['id' => 1, 'titulo' => 'Tech Conference 2024', 'data' => '2024-03-15', 'participantes' => 500], ['id' => 2, 'titulo' => 'Workshop Laravel', 'data' => '2024-04-10', 'participantes' => 120], ['id' => 3, 'titulo' => 'Empreendedorismo Digital', 'data' => '2024-05-05', 'participantes' => 300]]);
    }

    public function eventosRealizados()
    {
        return $this->eventos()->where('data', '<', now())->count();
    }

    public function eventosFuturos()
    {
        return $this->eventos()->where('data', '>=', now())->count();
    }

    public function totalParticipantes()
    {
        return $this->eventos()->sum('participantes');
    }

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'titulo', 'label' => 'Evento'], ['key' => 'data', 'label' => 'Data', 'class' => 'w-32'], ['key' => 'participantes', 'label' => 'Participantes', 'class' => 'w-20']];
    }

    public function verRelatorio($eventoId)
    {
        // Lógica para abrir os relatórios do evento
    }

    public function with(): array
    {
        return [
            'eventos' => $this->eventos(),
            'eventosRealizados' => $this->eventosRealizados(),
            'eventosFuturos' => $this->eventosFuturos(),
            'totalParticipantes' => $this->totalParticipantes(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Relatórios de Eventos" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Exportar Todos" icon="o-document-arrow-down" primary />
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-stat label="Eventos Realizados" icon="o-check-circle" :value="$eventosRealizados" />
        <x-stat label="Próximos Eventos" icon="o-clock" :value="$eventosFuturos" />
        <x-stat label="Total de Participantes" icon="o-users" :value="$totalParticipantes" />
    </div>

    <x-card class="mt-6">
        <x-table :headers="$headers" :rows="$eventos" :sort-by="$sortBy">
            @scope('actions', $evento)
                <x-button label="Ver Relatórios" icon="o-chart-bar" wire:click="verRelatorio({{ $evento['id'] }})"
                    primary />
            @endscope
        </x-table>
    </x-card>

    <x-card class="mt-6">
        <x-header title="Gerar Relatórios" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-button label="Relatório de Participantes" icon="o-document-text" />
            <x-button label="Relatório de Inscrições" icon="o-document-text" />
            <x-button label="Relatório de Presenças" icon="o-document-text" />
            <x-button label="Relatório Financeiro" icon="o-currency-dollar" />
        </div>

        <x-header title="Exportar Relatórios" />
        <div class="flex gap-4">
            <x-button label="Exportar PDF" icon="o-document-arrow-down" primary />
            <x-button label="Exportar Excel" icon="o-table-cells" secondary />
        </div>
    </x-card>



</div>
