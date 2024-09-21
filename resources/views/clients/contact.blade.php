@extends('clients.base')
@section('content')
        <!-- En-tête de la page Contact -->
        <header class="bg-blue-600 text-white py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold mb-4">Contactez-nous</h1>
                <p class="text-xl">Nous sommes là pour répondre à toutes vos questions.</p>
            </div>
        </header>
        <!-- Formulaire de contact -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8 animate-fade-in-up">
                    <form>
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom complet</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Adresse e-mail</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div class="mb-6">
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-700">Sujet</label>
                            <input type="text" id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-300">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Informations de contact -->
        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-2xl font-bold mb-8 text-center">Autres moyens de nous contacter</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center animate-fade-in-up">
                            <i class="fas fa-map-marker-alt text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Adresse</h3>
                            <p>123 Ngaba Salongo, Kinshasa</p>
                        </div>
                        <div class="text-center animate-fade-in-up">
                            <i class="fas fa-phone text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Téléphone</h3>
                            <p>+243 827786347</p>
                        </div>
                        <div class="text-center animate-fade-in-up">
                            <i class="fas fa-envelope text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Email</h3>
                            <p>contact@photoshop.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
