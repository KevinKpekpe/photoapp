@extends('clients.base')
@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Choisissez votre mode de paiement</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formulaire de paiement -->
            <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
                <h2 class="text-2xl font-bold mb-4">Informations de paiement</h2>
                <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nom complet</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Adresse e-mail</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Adresse de livraison</label>
                        <textarea id="address" name="address" class="w-full px-3 py-2 border rounded-lg @error('address') border-red-500 @enderror" rows="3" required>{{ old('address', $user->adresse ?? '') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Mode de paiement</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="mobile" class="mr-2" {{ old('payment_method') == 'mobile' ? 'checked' : '' }}>
                                Paiement mobile
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="cash" class="mr-2" {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                                Paiement à la livraison (Cash)
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="card" class="mr-2" {{ old('payment_method') == 'card' ? 'checked' : '' }}>
                                Carte bancaire
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
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
                    @foreach($cart as $id => $details)
                        <div class="flex justify-between mb-2">
                            <span>{{ $details['name'] }} (x{{ $details['quantity'] }})</span>
                            <span>{{ number_format($details['price'] * $details['quantity'], 2) }} €</span>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between mb-2">
                    <span>Sous-total</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Frais de livraison</span>
                    <span>Gratuit</span>
                </div>
                <div class="flex justify-between font-bold text-lg mt-4 pt-4 border-t">
                    <span>Total</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
