<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement réussi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center animate-fade-in-up">
        <img src="https://rsrspa.com/wp-content/uploads/2020/01/success-200x200.jpg.pagespeed.ce.S2kJWBbCGK.jpg" alt="Paiement réussi" class="mx-auto mb-8 w-64">
        <h1 class="text-4xl font-bold text-green-600 mb-4">Paiement réussi !</h1>
        <p class="text-xl text-gray-600 mb-8">Merci pour votre achat. Votre commande a été traitée avec succès.</p>
        <div class="space-x-4">
            <a href="/" class="bg-blue-600 text-white py-2 px-6 rounded-full text-lg hover:bg-blue-700 transition duration-300">Retour à l'accueil</a>
            <a href="/commandes" class="bg-green-600 text-white py-2 px-6 rounded-full text-lg hover:bg-green-700 transition duration-300">Voir mes commandes</a>
        </div>
    </div>
</body>

</html>
