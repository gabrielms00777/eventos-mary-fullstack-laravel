<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Públicos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="p-4 text-white shadow-md bg-primary">
        <div class="container flex items-center justify-between mx-auto">
            <h1 class="text-2xl font-bold">Sistema de Eventos</h1>
            <nav>
                <a href="#" class="px-4">Home</a>
                <a href="#" class="px-4">Sobre</a>
                <a href="#" class="px-4">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="flex items-center justify-center text-white bg-center bg-cover h-96"
        style="background-image: url('https://via.placeholder.com/1600x900');">
        <div class="text-center">
            <h2 class="text-4xl font-bold">Descubra Eventos Incríveis</h2>
            <p class="mt-2 text-lg">Participe dos melhores eventos perto de você.</p>
        </div>
    </section>

    <!-- Eventos -->
    <div class="container py-12 mx-auto">
        <h2 class="mb-6 text-3xl font-bold text-center">Eventos Disponíveis</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Evento Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-lg" v-for="evento in eventos">
                <img src="https://via.placeholder.com/400" alt="Evento" class="object-cover w-full h-56">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Teste</h3>
                    <p class="mt-2 text-gray-600">Testandoooooooo</p>
                    <a href="#" class="inline-block px-4 py-2 mt-4 text-white rounded bg-primary">Saiba mais</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const eventos = [{
                nome: "Festival de Música",
                descricao: "Um evento para amantes da música.",
                imagem: "https://via.placeholder.com/400"
            },
            {
                nome: "Feira de Tecnologia",
                descricao: "As últimas novidades tecnológicas.",
                imagem: "https://via.placeholder.com/400"
            },
            {
                nome: "Conferência de Negócios",
                descricao: "Networking e oportunidades de negócios.",
                imagem: "https://via.placeholder.com/400"
            }
        ];

        document.addEventListener('DOMContentLoaded', () => {
            const eventosContainer = document.querySelector('.grid');
            eventos.forEach(evento => {
                eventosContainer.innerHTML += `
                        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                            <img src="${evento.imagem}" alt="${evento.nome}" class="object-cover w-full h-56">
                            <div class="p-4">
                                <h3 class="text-xl font-bold">${evento.nome}</h3>
                                <p class="mt-2 text-gray-600">${evento.descricao}</p>
                                <a href="#" class="inline-block px-4 py-2 mt-4 text-white rounded bg-primary">Saiba mais</a>
                            </div>
                        </div>
                    `;
            });
        });
    </script>
</body>

</html>
