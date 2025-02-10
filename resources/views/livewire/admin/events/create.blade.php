<div>
    <x-header title="{{ __('event.create') }}" separator progress-indicator>
        <x-slot:actions>
            <x-button label="{{ __('event.back') }}" icon="o-arrow-left" secondary :link="route('admin.events.index')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="{{ __('event.name') }}" wire:model="form.name" class="col-span-2" />
                <x-input label="{{ __('event.max_participants') }}" type="number" wire:model="form.max_participants" />
                <div class="col-span-2">
                    <x-textarea label="{{ __('event.description') }}" wire:model="form.description" class="col-span-2" rows="4" />
                </div>
                <div class="col-span-2">
                    <x-input label="{{ __('event.location') }}" wire:model="form.location" />
                </div>
                <div class="flex gap-4 w-full">
                    <x-input label="{{ __('event.start_date') }}" type="datetime-local" wire:model="form.start_date" />
                    <x-input label="{{ __('event.end_date') }}" type="datetime-local" wire:model="form.end_date" />
                    <x-choices-offline
                        label="{{ __('event.company_id') }}"
                        wire:model="form.company_id"
                        :options="$this->companies"
                        placeholder="Search ..."
                        single
                        searchable />
                </div>

                <div class="col-span-2">
                    <x-input label="{{ __('event.image') }}" type="file" wire:model="form.image" />
                    @if ($form->image_url)
                        <div class="mt-2">
                            <img src="{{ $form->image_url }}" alt="Imagem do evento" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
            </div>

            <x-slot:actions>
                <x-button label="{{ __('event.save') }}" icon="o-check" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>