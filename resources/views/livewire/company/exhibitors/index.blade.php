<div>
    <x-header title="Expositores" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Novo Expositor" :link="route('company.exhibitors.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="[
            ['key' => 'name', 'label' => 'Nome'],
            ['key' => 'email', 'label' => 'E-mail'],
            ['key' => 'phone', 'label' => 'Telefone'],
            ['key' => 'actions', 'label' => 'Ações'],
        ]" :rows="$exhibitors">
            @scope('actions', $exhibitor)
                <x-button icon="o-pencil" wire:click="edit({{ $exhibitor->id }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="delete({{ $exhibitor->id }})" wire:confirm="Tem certeza?" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $exhibitors->links() }}
        </div>
    </x-card>
</div>