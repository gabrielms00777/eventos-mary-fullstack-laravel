<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <?php
    $evento = [
        'nome' => 'Festival de Música',
        'descricao' => 'Um evento para amantes da música com várias atrações.',
        'data' => '25 de Dezembro de 2024',
        'local' => 'Parque Central',
        'imagem' => 'https://via.placeholder.com/800x400',
    ];
    ?>

    <!-- Header -->
    <header class="bg-primary text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Sistema de Eventos</h1>
            <nav>
                <a href="/" class="px-4">Home</a>
                <a href="#" class="px-4">Sobre</a>
                <a href="#" class="px-4">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Detalhes do Evento -->
    <div class="container mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="<?= $evento['imagem'] ?>" alt="<?= $evento['nome'] ?>" class="w-full h-96 object-cover">
            <div class="p-6">
                <h2 class="text-4xl font-bold text-primary"> <?= $evento['nome'] ?> </h2>
                <p class="text-gray-600 mt-4"> <?= $evento['descricao'] ?> </p>
                <p class="mt-2"><strong>Data:</strong> <?= $evento['data'] ?> </p>
                <p class="mt-2"><strong>Local:</strong> <?= $evento['local'] ?> </p>
                <a href="#" class="mt-6 inline-block bg-primary text-white px-6 py-3 rounded">Inscrever-se</a>
            </div>
        </div>
    </div>
</body>

</html>
