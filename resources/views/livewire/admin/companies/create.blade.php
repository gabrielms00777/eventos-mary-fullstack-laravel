<div>
    <x-header title="{{ __('company.create') }}" separator progress-indicator>
        <x-slot:actions>
            <x-button label="{{ __('company.back') }}" icon="o-arrow-left" secondary :link="route('admin.companies.index')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input label="{{ __('company.name') }}" wire:model="form.name" />
                <x-input label="{{ __('company.cnpj') }}" wire:model="form.cnpj" mask="##.###.###/####-##" />
                <x-input label="{{ __('company.email') }}" type="email" wire:model="form.email" />
                <x-input label="{{ __('company.phone') }}" wire:model="form.phone" mask="(##) #####-####" />
                <div class="col-span-2">
                    <x-input label="{{ __('company.address') }}" wire:model="form.address" />
                </div>

                <!-- Novos campos para o responsável -->
                <div class="">
                    <h3 class="mb-4 text-lg font-semibold">{{ __('Responsible Information') }}</h3>
                    <x-input label="{{ __('Responsible Name') }}" wire:model="form.responsible_name" />
                    <x-input label="{{ __('Responsible Email') }}" type="email" wire:model="form.responsible_email" />
                </div>
            </div>

            <x-slot:actions>
                <x-button label="{{ __('company.save') }}" icon="o-check" class="btn-primary" type="submit"
                    spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
