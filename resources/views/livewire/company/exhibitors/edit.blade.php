<div>
    <x-header title="Editar Expositor" separator>
        <x-slot:actions>
            <x-button label="Voltar" icon="o-arrow-left" secondary :link="route('company.exhibitors.index')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome -->
                <x-input label="Nome" wire:model="form.name" placeholder="Digite o nome do expositor" />

                <!-- Empresa -->
                <x-input label="Empresa" wire:model="form.company" placeholder="Digite o nome da empresa" />

                <!-- Stand -->
                <x-input label="Stand" wire:model="form.stand" placeholder="Digite o número do stand" />

                <!-- E-mail -->
                <x-input label="E-mail" wire:model="form.email" type="email" placeholder="Digite o e-mail do expositor" />

                <!-- Telefone -->
                <x-input label="Telefone" wire:model="form.phone" mask="(##) #####-####" placeholder="Digite o telefone do expositor" />
            </div>

            <x-slot:actions>
                <x-button label="Atualizar" icon="o-check" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>