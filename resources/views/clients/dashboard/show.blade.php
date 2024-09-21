@extends('clients.base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Détails de la commande #{{ $order->code }}</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Informations de la commande</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Date de commande:</p>
                        <p class="font-semibold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Statut:</p>
                        <p class="font-semibold">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' :
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total:</p>
                        <p class="font-semibold">{{ number_format($order->total, 2) }} €</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Méthode de paiement:</p>
                        <p class="font-semibold">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Articles commandés</h2>
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Produit</th>
                            <th class="px-4 py-2 text-left">Quantité</th>
                            <th class="px-4 py-2 text-left">Prix unitaire</th>
                            <th class="px-4 py-2 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->product->name }}</td>
                            <td class="border px-4 py-2">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2">{{ number_format($item->price, 2) }} €</td>
                            <td class="border px-4 py-2">{{ number_format($item->quantity * $item->price, 2) }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="border px-4 py-2 font-semibold text-right">Total:</td>
                            <td class="border px-4 py-2 font-semibold">{{ number_format($order->total, 2) }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('client.orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Retour aux commandes
            </a>
            @if($order->status === 'pending')
            <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande?');">
                @csrf
                @method('POST')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Annuler la commande
                </button>
            </form>
            @endif
            <a href="{{ route('client.orders.track', $order->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Suivre la commande
            </a>
        </div>
    </div>
</div>
@endsection
