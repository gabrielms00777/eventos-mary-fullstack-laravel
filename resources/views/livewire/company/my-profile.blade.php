<div>
    <x-header title="Perfil do Usuário" separator>
        <x-slot:actions>
            <x-button label="Salvar" icon="o-check" wire:click="save" spinner="save" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nome -->
                <x-input label="Nome" wire:model="name" placeholder="Digite o seu nome" />

                <!-- E-mail -->
                <x-input label="E-mail" wire:model="email" type="email" placeholder="Digite o seu e-mail" />

                <!-- Senha Atual -->
                <x-input label="Senha Atual" wire:model="currentPassword" type="password" placeholder="Digite a senha atual" />

                <!-- Nova Senha -->
                <x-input label="Nova Senha" wire:model="newPassword" type="password" placeholder="Digite a nova senha" />

                <!-- Confirmação da Nova Senha -->
                <x-input label="Confirmar Nova Senha" wire:model="newPasswordConfirmation" type="password" placeholder="Confirme a nova senha" />
            </div>
        </x-form>
    </x-card>
</div>