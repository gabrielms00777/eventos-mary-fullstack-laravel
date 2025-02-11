<div>
    <x-header title="Meus Eventos" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <x-card>
        <x-table :headers="[
            ['key' => 'name', 'label' => 'Nome'],
            ['key' => 'start_date', 'label' => 'Data de Início'],
            ['key' => 'location', 'label' => 'Local'],
            ['key' => 'actions', 'label' => 'Ações'],
        ]" :rows="$events">
            @scope('cell_start_date', $event)
                {{ $event->start_date->format('d/m/Y H:i') }}
            @endscope

            @scope('actions', $event)
                <x-button icon="o-eye" wire:click="viewEvent({{ $event->id }})" spinner class="btn-ghost btn-sm text-blue-500" />
            @endscope
        </x-table>

    </x-card>
</div>