@extends('clients.base')
@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Choisissez votre mode de paiement</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formulaire de paiement -->
            <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                <h2 class="text-2xl font-bold mb-4">Informations de paiement</h2>
                <form id="payment-form">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nom complet</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Adresse e-mail</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Adresse de livraison</label>
                        <textarea id="address" name="address" class="w-full px-3 py-2 border rounded-lg" rows="3" required></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Mode de paiement</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="mobile" class="mr-2">
                                Paiement mobile
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="cash" class="mr-2">
                                Paiement à la livraison (Cash)
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="card" class="mr-2">
                                Carte bancaire
                            </label>
                        </div>
                    </div>
                    <div id="card-details" class="hidden mb-4">
                        <div class="mb-4">
                            <label for="card_number" class="block text-gray-700 font-bold mb-2">Numéro de carte</label>
                            <input type="text" id="card_number" name="card_number" class="w-full px-3 py-2 border rounded-lg" placeholder="1234 5678 9012 3456">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="expiry" class="block text-gray-700 font-bold mb-2">Date d'expiration</label>
                                <input type="text" id="expiry" name="expiry" class="w-full px-3 py-2 border rounded-lg" placeholder="MM/AA">
                            </div>
                            <div>
                                <label for="cvv" class="block text-gray-700 font-bold mb-2">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="w-full px-3 py-2 border rounded-lg" placeholder="123">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                        Confirmer le paiement
                    </button>
                </form>
            </div>

            <!-- Résumé de la commande -->
            <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                <h2 class="text-2xl font-bold mb-4">Résumé de la commande</h2>
                <div class="mb-4">
                    <div class="flex justify-between mb-2">
                        <span>Appareil photo Canon EOS R5</span>
                        <span>3 499,99 €</span>
                    </div>
                    <!-- Ajoutez d'autres produits ici si nécessaire -->
                </div>
                <div class="flex justify-between mb-2">
                    <span>Sous-total</span>
                    <span>3 499,99 €</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Frais de livraison</span>
                    <span>Gratuit</span>
                </div>
                <div class="flex justify-between font-bold text-lg mt-4 pt-4 border-t">
                    <span>Total</span>
                    <span>3 499,99 €</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentForm = document.getElementById('payment-form');
        const cardDetails = document.getElementById('card-details');
        const paymentMethods = document.getElementsByName('payment_method');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'card') {
                    cardDetails.classList.remove('hidden');
                } else {
                    cardDetails.classList.add('hidden');
                }
            });
        });

        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Ici, vous pouvez ajouter la logique pour traiter le paiement
            alert('Paiement confirmé ! Merci pour votre commande.');
        });
    });
</script>
@endsection
