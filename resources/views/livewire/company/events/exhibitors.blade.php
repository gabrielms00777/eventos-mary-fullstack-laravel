<div>
    <x-header title="Expositores no Evento" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Adicionar Selecionados" icon="o-user-plus" wire:click="addSelected" spinner class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table
            :headers="[
                ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
                ['key' => 'name', 'label' => 'Nome'],
                ['key' => 'email', 'label' => 'E-mail'],
                ['key' => 'phone', 'label' => 'Telefone'],
                ['key' => 'is_linked', 'label' => 'Vinculado ao Evento'],
                ['key' => 'actions', 'label' => 'Ações'],
            ]"
            :rows="$exhibitors"
            wire:model="selected"
            selectable
        >
            @scope('cell_is_linked', $exhibitor)
                @if ($event->exhibitors->contains($exhibitor->id))
                    <span class="text-green-500">Sim</span>
                @else
                    <span class="text-red-500">Não</span>
                @endif
            @endscope

            @scope('actions', $exhibitor)
                @if ($event->exhibitors->contains($exhibitor->id))
                    <x-button icon="o-user-minus" wire:click="removeFromEvent({{ $exhibitor->id }})" spinner class="btn-ghost btn-sm text-red-500" />
                @endif
            @endscope
        </x-table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $exhibitors->links() }}
        </div>
    </x-card>
</div>