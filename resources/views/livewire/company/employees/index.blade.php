<div>
    <x-header title="Funcionários" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Adicionar Funcionário" icon="o-plus" :link="route('company.employees.create')" spinner class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table
            :headers="$headers"
            :rows="$this->employees"
            wire:model="selected"
            selectable
            with-pagination
            @row-selection="console.log($event.detail)"
        >
            @scope('cell_is_linked', $employee)
                @if ($this->event->employees->contains($employee->id))
                    <span class="text-green-500">Sim</span>
                @else
                    <span class="text-red-500">Não</span>
                @endif
            @endscope

            @scope('actions', $employee)
                @if ($this->event->employees->contains($employee->id))
                    <x-button icon="o-user-minus" wire:click="removeFromEvent({{ $employee->id }})" spinner
                        class="btn-ghost btn-sm text-red-500" />
                @else
                    <x-button icon="o-user-plus" wire:click="addToEvent({{ $employee->id }})" spinner
                        class="btn-ghost btn-sm text-green-500" />
                @endif
            @endscope
        </x-table>
    </x-card>
</div>