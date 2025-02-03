<div>
    <x-header title="Eventos" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Novo Evento" :link="route('admin.events.create')" icon="o-plus" primary />
        </x-slot:actions>
    </x-header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-stat label="Eventos Realizados" icon="o-check-circle" :value="$eventsRealizados" />
        <x-stat label="Próximos Eventos" icon="o-clock" :value="$eventsFuturos" />
        <x-stat label="Total de Eventos" icon="o-calendar-days" :value="$totalevents" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        {{-- @foreach ($this->events as $event)
            <x-card title="{{ $event->name }}">
                <p>{{ $event->start_date }} / {{ $event->end_date }} -
                    {{ $event->location }}</p>

                <x-slot:figure>
                    <img src="https://picsum.photos/500/200" />
                </x-slot:figure>
                <x-slot:menu>
                    <x-button icon="o-share" class="btn-circle btn-sm" />
                    <x-icon name="o-heart" class="cursor-pointer" />
                </x-slot:menu>
                <x-button label="Ver Evento" :link="route('admin.events.edit', $event->id)" class="mt-4 btn-primary w-full" />
            </x-card>
        @endforeach --}}
        @foreach ($this->events as $event)
            <x-card class="p-4">
                {{-- <img src="{{ $event->image_url }}" class="w-full h-40 object-cover rounded-lg" /> --}}
                <img src="https://picsum.photos/500/200" class="w-full h-40 object-cover rounded-lg" />
                <h2 class="text-lg font-bold mt-4">{{ $event->name }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ $event->start_date }} / {{ $event->end_date }} -
                    {{ $event->adreess }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($event->descricao, 100) }}</p>
                <x-button label="Ver Evento" :link="route('admin.events.edit', $event->id)" class="mt-4 w-full" primary />
            </x-card>
        @endforeach
    </div>
    <br>
    {{ $this->events->links() }}
</div>
