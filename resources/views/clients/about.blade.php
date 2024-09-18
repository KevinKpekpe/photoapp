@extends('clients.base')
@section('content')

    <!-- Hero Section -->
    <header class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4 animate-fade-in-up">Notre Histoire</h1>
            <p class="text-xl animate-fade-in-up">Découvrez l'aventure passionnante de PhotoShop</p>
        </div>
    </header>

    <!-- Notre Histoire -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0 animate-fade-in-up">
                    <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Notre boutique" class="rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 animate-fade-in-up">
                    <h2 class="text-3xl font-bold mb-4">Une passion pour la photographie</h2>
                    <p class="text-gray-600 mb-4">
                        Fondée en 2005 par deux passionnés de photographie, Marie et Thomas, PhotoShop est née d'un rêve simple : partager notre amour pour l'art de la photographie avec le monde entier.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Ce qui a commencé comme une petite boutique dans le cœur de Paris s'est rapidement transformé en une destination incontournable pour les photographes amateurs et professionnels. Notre engagement envers la qualité et notre service client exceptionnel nous ont permis de grandir et de nous développer au fil des années.
                    </p>
                    <p class="text-gray-600">
                        Aujourd'hui, PhotoShop est fière de proposer une large gamme de produits de haute qualité, des conseils d'experts et une communauté passionnée de photographes du monde entier.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Mission -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center animate-fade-in-up">Notre Mission</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <i class="fas fa-camera text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Inspirer la créativité</h3>
                    <p class="text-gray-600">Nous nous efforçons d'inspirer et d'encourager la créativité chez tous les photographes, quel que soit leur niveau.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Construire une communauté</h3>
                    <p class="text-gray-600">Nous créons un espace où les passionnés de photographie peuvent se rencontrer, apprendre et grandir ensemble.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <i class="fas fa-star text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Offrir l'excellence</h3>
                    <p class="text-gray-600">Nous nous engageons à fournir des produits de la plus haute qualité et un service client exceptionnel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center animate-fade-in-up">Ce que disent nos clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Sophie Dubois</h4>
                            <p class="text-gray-600 text-sm">Photographe amateur</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"PhotoShop a complètement transformé ma façon de voir la photographie. Leur équipe m'a guidée vers le bon équipement et m'a donné des conseils précieux pour améliorer mes compétences."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Marc Leroy</h4>
                            <p class="text-gray-600 text-sm">Photographe professionnel</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"En tant que professionnel, je ne fais confiance qu'à PhotoShop pour mon équipement. Leur sélection de produits haut de gamme et leur service après-vente sont inégalés."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Émilie Martin</h4>
                            <p class="text-gray-600 text-sm">Étudiante en photographie</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Les ateliers organisés par PhotoShop m'ont permis d'apprendre énormément et de rencontrer d'autres passionnés. C'est bien plus qu'une simple boutique, c'est une véritable communauté !"</p>
                </div>
            </div>
        </div>
    </section>
@endsection
