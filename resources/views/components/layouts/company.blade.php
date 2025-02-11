<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

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
    <x-nav sticky class="bg-blue-700 lg:hidden">
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
                @endif

                <x-menu-item title="Dashboard" icon="o-home" :link="route('company.dashboard')" />
                <x-menu-item title="Meus Eventos" icon="o-calendar" :link="route('company.events.index')" />

                <!-- Gerenciar Funcionários e Visitantes -->
                <x-menu-sub title="Cadastros" icon="o-user-plus">
                    <x-menu-item title="Funcionários" icon="o-users" :link="route('company.employees.index')" />
                    <x-menu-item title="Visitantes" icon="o-user-group" :link="route('company.visitors.index')" />
                    <x-menu-item title="Expositores" icon="o-presentation-chart-bar" :link="route('company.exhibitors.index')" />
                </x-menu-sub>

                <!-- Gerenciar Participação no Evento -->
                <x-menu-sub title="Evento Atual" icon="o-calendar-days">
                    <x-menu-item title="Funcionários no Evento" icon="o-users" :link="route('company.events.employees')" />
                    <x-menu-item title="Visitantes no Evento" icon="o-user-group" :link="route('company.events.visitors')" />
                    <x-menu-item title="Expositores no Evento" icon="o-presentation-chart-bar" :link="route('company.events.exhibitors')" />
                </x-menu-sub>

                <!-- Configurações -->
                <x-menu-sub title="Configurações" icon="o-cog-6-tooth">
                    <x-menu-item title="Meu Perfil" icon="o-user" :link="route('company.my-profile')" />
                    <x-menu-item title="Perfil da Empresa" icon="o-building-office" :link="route('company.profile')" />
                    <x-menu-item title="Gerenciar Acessos" icon="o-key" :link="route('company.access.index')" />
                </x-menu-sub>

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
