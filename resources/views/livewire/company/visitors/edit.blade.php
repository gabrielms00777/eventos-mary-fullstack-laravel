<div>
    <x-header title="Editar Visitante" separator>
        <x-slot:actions>
            <x-button label="Voltar" icon="o-arrow-left" secondary :link="route('company.visitors.index')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome -->
                <x-input label="Nome" wire:model="form.name" placeholder="Digite o nome do visitante" />

                <!-- E-mail -->
                <x-input label="E-mail" wire:model="form.email" type="email" placeholder="Digite o e-mail do visitante" />

                <!-- Telefone -->
                <x-input label="Telefone" wire:model="form.phone" mask="(##) #####-####" placeholder="Digite o telefone do visitante" />

                <!-- Empresa -->
                <x-input label="Empresa" wire:model="form.company" placeholder="Digite o nome da empresa" />

                <!-- Cargo -->
                <x-input label="Cargo" wire:model="form.position" placeholder="Digite o cargo do visitante" />
            </div>

            <x-slot:actions>
                <x-button label="Atualizar" icon="o-check" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>