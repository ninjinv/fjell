<?php
  include 'registrering.php';
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP registrering</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">  
    <h1 class="text-xl font-semibold">Velkommen til Fjell</h1>  
        <nav class="space-x-4">
            <a href="regpg.php" class="text-blue-500 hover:underline">Registrer deg her</a>
            <a href="loginpg.php" class="text-blue-500 hover:underline">Logg inn her</a>
        </nav>
    </div>
</div>

    <div class="container mx-auto py-12 max-w-md">
        <h1 class="text-3xl font-bold text-center mb-8">Opprett ny bruker:</h1>
        <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="kallenavn" class="block text-gray-700 text-sm font-bold mb-2">Kallenavn:</label>
                <input type="text" name="kallenavn" class="form-input w-full px-4 py-2 rounded shadow appearance-none" required>
            </div>
            <div class="mb-4">
                <label for="epost" class="block text-gray-700 text-sm font-bold mb-2">E-post:</label>
                <input type="text" name="epost" class="form-input w-full px-4 py-2 rounded shadow appearance-none" required>
            </div>
            <div class="mb-6">
                <label for="pwd" class="block text-gray-700 text-sm font-bold mb-2">Passord:</label>
                <input type="password" name="pwd" class="form-input w-full px-4 py-2 rounded shadow appearance-none" required>
            </div>
            <div class="flex items-center justify-between">
                <input type="submit" value="Registrer her" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            </div>
        </form>    
    </div>
</body>

</html>