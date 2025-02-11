<div>
    <x-header title="Visitantes" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Novo Visitante" :link="route('company.visitors.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$this->visitors" with-pagination>
            @scope('actions', $visitor)
                <x-button icon="o-pencil" wire:click="edit({{ $visitor->id }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $visitor->id }})" wire:confirm="Tem certeza?" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>

    </x-card>
</div>