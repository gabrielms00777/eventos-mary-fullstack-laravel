<div>
    <x-header title="Dashboard" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="$refresh" spinner />
        </x-slot:actions>
    </x-header>

    <x-card>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Eventos Vinculados -->
            @foreach ($events as $event)
                <x-card class="p-4">
                    <h3 class="text-lg font-semibold">{{ $event->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $event->description }}</p>
                    <p class="text-sm text-gray-600">Data: {{ $event->start_date->format('d/m/Y H:i') }}</p>
                    <p class="text-sm text-gray-600">Local: {{ $event->location }}</p>
                </x-card>
            @endforeach
        </div>
    </x-card>
</div>