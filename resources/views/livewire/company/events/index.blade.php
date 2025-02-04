<div>
    <x-header title="Meus Eventos" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refreshDashboard" />
        </x-slot:actions>
    </x-header>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($this->events as $event)
            <x-card class="mb-4" title="{{ $event['name'] }}"> {{-- Adiciona margem inferior entre os cards --}}
                <img src="{{ $event['image'] }}" alt="Banner do Evento" class="w-full h-40 object-cover rounded-t-lg">
                {{-- Adiciona arredondamento no topo da imagem --}}

                <div class="p-4">
                    <p class="text-gray-600">{{ date('d/m/Y', strtotime($event['date'])) }} - {{ $event['location'] }}
                    </p>

                    <div class="mt-4">
                        @if ($event['status'] === 'upcoming')
                            <x-button primary> {{-- Botão primário --}}
                                Selecionar Evento
                            </x-button>
                        @else
                            <x-button secondary> {{-- Botão secundário --}}
                                Visualizar Evento
                            </x-button>
                        @endif
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</div>
