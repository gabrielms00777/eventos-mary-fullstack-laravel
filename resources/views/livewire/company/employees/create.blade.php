<div>
    <x-header title="Cadastrar Funcionário" separator>
        <x-slot:actions>
            <x-button label="Voltar" icon="o-arrow-left" secondary :link="route('company.employees.index')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome -->
                <x-input label="Nome Completo" wire:model="form.name" placeholder="Digite o nome do funcionário" />

                <!-- E-mail -->
                <x-input label="E-mail" wire:model="form.email" type="email" placeholder="Digite o e-mail do funcionário" />

                <!-- Cargo (Enum EmployeeTypeEnum) -->
                <x-select
                    label="Cargo"
                    wire:model="form.role"
                    :options="[
                        ['id' => \App\Enums\EmployeeTypeEnum::ADMIN->value, 'name' => 'Administrador'],
                        ['id' => \App\Enums\EmployeeTypeEnum::MANAGER->value, 'name' => 'Gerente'],
                        ['id' => \App\Enums\EmployeeTypeEnum::STAFF->value, 'name' => 'Funcionário'],
                    ]"
                    option-value="id"
                    option-label="name"
                    placeholder="Selecione o cargo"
                />

                <!-- Posição (Ocupação na Empresa) -->
                <x-select
                    label="Posição"
                    wire:model="form.position"
                    :options="[
                        ['id' => 'developer', 'name' => 'Desenvolvedor'],
                        ['id' => 'designer', 'name' => 'Designer'],
                        ['id' => 'marketing', 'name' => 'Marketing'],
                        ['id' => 'sales', 'name' => 'Vendas'],
                        ['id' => 'support', 'name' => 'Suporte'],
                    ]"
                    option-value="id"
                    option-label="name"
                    placeholder="Selecione a posição"
                />

                <!-- Telefone -->
                <x-input label="Telefone" wire:model="form.phone" mask="(##) #####-####" placeholder="Digite o telefone do funcionário" />

                <!-- Senha Temporária -->
                <x-input label="Senha Temporária" wire:model="form.temp_password" type="password" placeholder="Digite uma senha temporária" />

                <!-- Confirmação de Senha -->
                <x-input label="Confirmar Senha" wire:model="form.temp_password_confirmation" type="password" placeholder="Confirme a senha temporária" />
            </div>

            <x-slot:actions>
                <x-button label="Salvar" icon="o-check" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>