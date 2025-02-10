<div>
    <x-header title="Meus Eventos" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refreshDashboard" />
        </x-slot:actions>
    </x-header>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($this->events as $event)
            <x-card class="mb-4" title="{{ $event->name }}">
                <img src="{{ $event->image }}" alt="Banner do Evento" class="w-full h-40 object-cover rounded-t-lg">

                <div class="p-4">
                    <p class="text-gray-600">{{ date('d/m/Y', strtotime($event->date)) }} - {{ $event->location }}
                    </p>

                    <div class="mt-4">
                        @if (auth()->user()->last_event_id === $event->id)
                            <x-button secondary disabled>
                                Evento Ativo
                            </x-button>
                        @else
                            <x-button primary>
                                Selecionar Evento
                            </x-button>
                        @endif
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</div>
