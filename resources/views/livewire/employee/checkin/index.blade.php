<div>
    <x-header title="Check-in" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <x-card>
        <h3 class="text-lg font-semibold mb-4">Evento: {{ $event->name ?? 'Nenhum evento selecionado' }}</h3>

        <!-- Visitantes -->
        <div class="mb-8">
            <h4 class="text-md font-semibold mb-2">Visitantes</h4>
            <x-table :headers="[
                ['key' => 'name', 'label' => 'Nome'],
                ['key' => 'email', 'label' => 'E-mail'],
                ['key' => 'checked_in_at', 'label' => 'Check-in'],
                ['key' => 'actions', 'label' => 'Ações'],
            ]" :rows="$visitors">
                @scope('cell_checked_in_at', $visitor)
                    @if ($visitor->checked_in_at)
                        <span class="text-green-500">{{ $visitor->checked_in_at->format('d/m/Y H:i') }}</span>
                    @else
                        <span class="text-red-500">Pendente</span>
                    @endif
                @endscope

                @scope('actions', $visitor)
                    @if (!$visitor->checked_in_at)
                        <x-button icon="o-check" wire:click="checkInVisitor({{ $visitor->id }})" spinner class="btn-ghost btn-sm text-green-500" />
                    @endif
                @endscope
            </x-table>
        </div>

        <!-- Expositores -->
        <div>
            <h4 class="text-md font-semibold mb-2">Expositores</h4>
            <x-table :headers="[
                ['key' => 'name', 'label' => 'Nome'],
                ['key' => 'email', 'label' => 'E-mail'],
                ['key' => 'checked_in_at', 'label' => 'Check-in'],
                ['key' => 'actions', 'label' => 'Ações'],
            ]" :rows="$exhibitors">
                @scope('cell_checked_in_at', $exhibitor)
                    @if ($exhibitor->checked_in_at)
                        <span class="text-green-500">{{ $exhibitor->checked_in_at->format('d/m/Y H:i') }}</span>
                    @else
                        <span class="text-red-500">Pendente</span>
                    @endif
                @endscope

                @scope('actions', $exhibitor)
                    @if (!$exhibitor->checked_in_at)
                        <x-button icon="o-check" wire:click="checkInExhibitor({{ $exhibitor->id }})" spinner class="btn-ghost btn-sm text-green-500" />
                    @endif
                @endscope
            </x-table>
        </div>
    </x-card>
</div>