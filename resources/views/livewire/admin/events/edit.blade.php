@script
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endscript
<div>
    <x-header title="Visualizar Evento" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Voltar" icon="o-arrow-left" :link="route('admin.events.index')" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card title="Dados do evento" x-data="{ isEditing: $wire.entangle('isEditing').live }">
        <span x-text="isEditing ? 'Editar Evento' : 'Visualizar Evento'"></span>
        <button @click="isEditing = !isEditing">mudar</button>
        <input type="text" name="" id="" :disabled="!isEditing">
        {{ $isEditing }}
        <div class="mb-4">
            <img src="{{ $event->image_url }}" alt="Imagem do Evento" class="w-full h-64 object-cover rounded-lg" />
        </div>
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Nome do Evento" wire:model="form.name" :disabled="!$isEditing" required />
                <x-input label="Localização" wire:model="form.location" :disabled="!$isEditing" required />
                <x-input label="Máx. Participantes" type="number" wire:model="form.max_participants" :disabled="!$isEditing"
                    required />
                <x-datepicker label="Data de Início" type="date" wire:model="form.start_date" :disabled="!$isEditing"
                    required />
                <x-datepicker label="Data de Término" type="date" wire:model="form.end_date" :disabled="!$isEditing"
                    required />
                <x-choices-offline label="Empresa responsavel" wire:model="form.company_id" :options="$this->companies"
                    :disabled="!$isEditing" placeholder="Search ..." single searchable />
            </div>

            <x-textarea label="Descrição" wire:model="form.description" :disabled="!$isEditing" required />
            <div class="flex justify-end mt-4">
                @if ($isEditing)
                    <x-button label="Salvar" icon="o-check" primary wire:click="save" />
                @else
                    {{-- <x-button label="Editar" icon="o-pencil" primary wire:click="$set('isEditing', true)" /> --}}
                    <x-button label="Editar" icon="o-pencil" primary @click="isEditing = true" />
                @endif
            </div>
        </x-form>
    </x-card>

</div>
