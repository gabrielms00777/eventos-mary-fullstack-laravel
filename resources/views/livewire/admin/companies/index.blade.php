<div>
    <x-header title="Empresas" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Nova Empresa" :link="route('admin.companies.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :$headers :rows="$this->rows" :$sortBy striped with-pagination>
            @scope('actions', $company)
                <div class="flex gap-2">
                    <x-button icon="o-pencil" :link="route('admin.companies.edit', $company->id)" spinner class="btn-ghost btn-sm text-blue-500" />
                    <x-button icon="o-trash" wire:click="delete({{ $company['id'] }})" wire:confirm="Tem certeza?" spinner
                        class="btn-ghost btn-sm text-red-500" />
                </div>
            @endscope
        </x-table>
    </x-card>

</div>
