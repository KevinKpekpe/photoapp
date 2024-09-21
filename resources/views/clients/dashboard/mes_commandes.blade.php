<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord client - PhotoShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md" x-data="{ isOpen: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="index.html" class="text-xl font-bold text-gray-800">PhotoShop</a>
                </div>
                <div class="hidden md:flex space-x-4">
                    <a href="index.html" class="text-gray-600 hover:text-gray-800">Accueil</a>
                    <a href="about-us.html" class="text-gray-600 hover:text-gray-800">À propos</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800">Produits</a>
                    <a href="contact.html" class="text-gray-600 hover:text-gray-800">Contact</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-blue-600 font-semibold">Mon compte</a>
                    <a href="login.html" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Déconnexion</a>
                </div>
                <button @click="isOpen = !isOpen" class="md:hidden text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path x-show="!isOpen" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="isOpen" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div x-show="isOpen" class="md:hidden">
            <a href="index.html" class="block py-2 px-4 text-gray-600 hover:bg-gray-100">Accueil</a>
            <a href="about-us.html" class="block py-2 px-4 text-gray-600 hover:bg-gray-100">À propos</a>
            <a href="#" class="block py-2 px-4 text-gray-600 hover:bg-gray-100">Produits</a>
            <a href="contact.html" class="block py-2 px-4 text-gray-600 hover:bg-gray-100">Contact</a>
            <a href="#" class="block py-2 px-4 text-blue-600 font-semibold">Mon compte</a>
            <a href="login.html" class="block py-2 px-4 text-gray-600 hover:bg-gray-100">Déconnexion</a>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mx-auto px-4 py-8 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md rounded-lg p-6 mr-8 h-full">
            <h2 class="text-xl font-semibold mb-6">Menu</h2>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-shopping-cart mr-2"></i> Mes commandes
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-user mr-2"></i> Mon profil
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-key mr-2"></i> Changer le mot de passe
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded transition duration-200">
                            <i class="fas fa-edit mr-2"></i> Modifier le profil
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-8 animate-fade-in-up">Tableau de bord</h1>

            <!-- User Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 animate-fade-in-up">
                <h2 class="text-2xl font-semibold mb-4">Informations personnelles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Nom: <span class="font-semibold">Jean Dupont</span></p>
                        <p class="text-gray-600">Email: <span class="font-semibold">jean.dupont@example.com</span></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Téléphone: <span class="font-semibold">+33 1 23 45 67 89</span></p>
                        <p class="text-gray-600">Adresse: <span class="font-semibold">123 Rue de la Photo, 75000 Paris</span></p>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="bg-white rounded-lg shadow-md p-6 animate-fade-in-up">
                <h2 class="text-2xl font-semibold mb-4">Mes commandes</h2>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">N° de commande</th>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Montant</th>
                                <th class="px-4 py-2 text-left">État</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">#12345</td>
                                <td class="border px-4 py-2">01/05/2023</td>
                                <td class="border px-4 py-2">249,99 €</td>
                                <td class="border px-4 py-2"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Livré</span></td>
                                <td class="border px-4 py-2">
                                    <button class="text-blue-600 hover:text-blue-800" onclick="toggleOrderDetails('order-12345')">Voir détails</button>
                                </td>
                            </tr>
                            <tr id="order-12345" class="hidden bg-gray-50">
                                <td colspan="5" class="border px-4 py-2">
                                    <h3 class="font-semibold mb-2">Détails de la commande #12345</h3>
                                    <ul>
                                        <li>Canon EOS R6 - 1999,99 €</li>
                                        <li>Objectif Canon RF 24-105mm f/4L IS USM - 1299,99 €</li>
                                    </ul>
                                    <p class="mt-2">Total: 3299,98 €</p>
                                    <p>Adresse de livraison: 123 Rue de la Photo, 75000 Paris</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">#12346</td>
                                <td class="border px-4 py-2">15/04/2023</td>
                                <td class="border px-4 py-2">99,99 €</td>
                                <td class="border px-4 py-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">En cours</span></td>
                                <td class="border px-4 py-2">
                                    <button class="text-blue-600 hover:text-blue-800" onclick="toggleOrderDetails('order-12346')">Voir détails</button>
                                </td>
                            </tr>
                            <tr id="order-12346" class="hidden bg-gray-50">
                                <td colspan="5" class="border px-4 py-2">
                                    <h3 class="font-semibold mb-2">Détails de la commande #12346</h3>
                                    <ul>
                                        <li>Trépied Manfrotto - 99,99 €</li>
                                    </ul>
                                    <p class="mt-2">Total: 99,99 €</p>
                                    <p>Adresse de livraison: 123 Rue de la Photo, 75000 Paris</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">PhotoShop</h3>
                    <p class="text-gray-400">Votre destination pour tout ce qui concerne la photographie.</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Liens rapides</h3>
                    <ul class="text-gray-400">
                        <li><a href="#" class="hover:text-white">Accueil</a></li>
                        <li><a href="#" class="hover:text-white">Produits</a></li>
                        <li><a href="#" class="hover:text-white">À propos</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Contact</h3>
                    <p class="text-gray-400">123 Rue de la Photo<br>75000 Paris, France</p>
                    <p class="text-gray-400">Téléphone: +33 1 23 45 67 89</p>
                    <p class="text-gray-400">Email: info@photoshop.com</p>
                </div>
                <div class="w-full md:w-1/4">
                    <h3 class="text-lg font-semibold mb-2">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-gray-400 text-center">
                <p>&copy; 2023 PhotoShop. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleOrderDetails(orderId) {
            const orderDetails = document.getElementById(orderId);
            orderDetails.classList.toggle('hidden');
        }
    </script>
</body>

</html>
