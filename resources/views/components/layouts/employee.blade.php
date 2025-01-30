<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="corporate">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if ($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>
                    <x-menu-separator />
                    @php
                        $users = [
                            [
                                'id' => 1,
                                'name' => 'Evento 1',
                            ],
                            [
                                'id' => 2,
                                'name' => 'Evento 2',
                                'disabled' => true,
                            ],
                            [
                                'id' => 3,
                                'name' => 'Evento 3',
                            ],
                        ];
                    @endphp

                    <x-select label="Selecione o Evento" class="rounded-lg" :options="$users" />

                    <x-menu-separator />
                @endif

                <x-menu-item title="Dashboard" icon="o-home" link="/staff/dashboard" />
                <x-menu-item title="Eventos Ativos" icon="o-calendar" link="/staff/events" />
                <x-menu-item title="Check-in Visitantes" icon="o-check-circle" link="/staff/checkin" />
                <x-menu-item title="Relatórios de Acesso" icon="o-clipboard-document" link="/staff/relatorios" />

            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
    @livewireScripts
</body>

</html>
