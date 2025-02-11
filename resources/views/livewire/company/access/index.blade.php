<div>
    <x-header title="Gerenciar Acessos" separator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <x-card>
        <x-table :headers="[
            ['key' => 'name', 'label' => 'Nome'],
            ['key' => 'email', 'label' => 'E-mail'],
            ['key' => 'role', 'label' => 'Papel'],
            ['key' => 'actions', 'label' => 'Ações'],
        ]" :rows="$users">
            @scope('cell_role', $user)
                <x-select
                    wire:model="user.role"
                    :options="[
                        ['id' => \App\Enums\UserTypeEnum::ADMIN->value, 'name' => 'Administrador'],
                        ['id' => \App\Enums\UserTypeEnum::MANAGER->value, 'name' => 'Gerente'],
                        ['id' => \App\Enums\UserTypeEnum::EMPLOYEE->value, 'name' => 'Funcionário'],
                    ]"
                    option-value="id"
                    option-label="name"
                    wire:change="updateRole({{ $user->id }}, $event.target.value)"
                />
            @endscope

            @scope('actions', $user)
                <x-button icon="o-trash" wire:click="delete({{ $user->id }})" wire:confirm="Tem certeza?" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>