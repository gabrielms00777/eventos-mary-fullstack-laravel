<div>
    <x-header title="Dashboard - {{ $event->name }}" separator>
        <x-slot:actions>
            <x-button label="Atualizar" icon="o-arrow-path" wire:click="refreshDashboard" />
        </x-slot:actions>
    </x-header>

    <div class="space-y-8">
        <!-- Banner do Evento -->
        <div class="relative">
            <img src="{{ $event->image_url }}" alt="Event Banner"
                class="w-full h-64 rounded-lg shadow-lg object-cover" />
            <div class="absolute bottom-4 left-4 bg-black bg-opacity-60 text-white p-4 rounded-lg">
                <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                <p class="text-sm">Faltam {{ $daysLeft }} dias para o evento</p>
            </div>
        </div>

        <!-- Métricas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Dias Restantes -->
            <x-card title="Dias Restantes">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $daysLeft }}
                </div>
            </x-card>

            <!-- Visitantes Inscritos -->
            <x-card title="Visitantes Inscritos">
                <div>
                    <p class="text-4xl font-bold text-gray-700">
                        {{ $registeredVisitors }} / {{ $totalVisitors }}
                    </p>
                    <x-progress value="{{ $totalVisitors > 0 ? ($registeredVisitors / $totalVisitors) * 100 : 0 }}" />
                </div>
            </x-card>

            <!-- Equipe -->
            <x-card title="Equipe">
                <div class="text-4xl font-bold text-gray-700">
                    {{ $totalStaff }}
                </div>
            </x-card>

            <!-- Tarefas Concluídas -->
            <x-card title="Tarefas Concluídas">
                <div>
                    <p class="text-4xl font-bold text-gray-700">
                        {{ $completedTasks }} / {{ $totalTasks }}
                    </p>
                    <x-progress value="{{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}" />
                </div>
            </x-card>
        </div>
    </div>
</div>