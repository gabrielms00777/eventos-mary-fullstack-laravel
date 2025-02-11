<div>
    <x-header title="Visitantes no Evento" separator>
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
            :rows="$this->visitors" 
            wire:model="selected"
            selectable
            with-pagination
        >
            @scope('cell_is_linked', $visitor)
                @if ($event->visitors->contains($visitor->id))
                    <span class="text-green-500">Sim</span>
                @else
                    <span class="text-red-500">Não</span>
                @endif
            @endscope

            @scope('actions', $visitor)
                @if ($event->visitors->contains($visitor->id))
                    <x-button icon="o-user-minus" wire:click="removeFromEvent({{ $visitor->id }})" spinner class="btn-ghost btn-sm text-red-500" />
                @endif
            @endscope
        </x-table>

    </x-card>
</div>