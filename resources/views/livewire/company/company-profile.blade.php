<div>
    <x-header title="Perfil da Empresa" separator>
        <x-slot:actions>
            <x-button label="Salvar" icon="o-check" wire:click="save" spinner="save" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome -->
                <x-input label="Nome" wire:model="name" placeholder="Digite o nome da empresa" />

                <!-- E-mail -->
                <x-input label="E-mail" wire:model="email" type="email" placeholder="Digite o e-mail da empresa" />

                <!-- Telefone -->
                <x-input label="Telefone" wire:model="phone" mask="(##) #####-####" placeholder="Digite o telefone da empresa" />

                <!-- Endereço -->
                <x-input label="Endereço" wire:model="address" placeholder="Digite o endereço da empresa" />

                <!-- Logo -->
                <div class="col-span-2">
                    <x-input label="Logo" wire:model="logo" type="file" accept="image/*" />
                    @if ($logoUrl)
                        <div class="mt-2">
                            <img src="{{ $logoUrl }}" alt="Logo da Empresa" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
            </div>
        </x-form>
    </x-card>
</div>