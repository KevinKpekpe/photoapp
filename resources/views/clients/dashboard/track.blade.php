@extends('clients.base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Suivi de la commande #{{ $order->code }}</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Informations de suivi</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Statut actuel:</p>
                        <p class="font-semibold">{{ $trackingInfo['status'] }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Localisation:</p>
                        <p class="font-semibold">{{ $trackingInfo['location'] }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Date de commande:</p>
                        <p class="font-semibold">{{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Livraison estimée:</p>
                        <p class="font-semibold">{{ $trackingInfo['estimated_delivery'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Étapes de livraison</h2>
                <div class="relative">
                    <div class="absolute h-full w-1 bg-gray-200 left-1/2 transform -translate-x-1/2"></div>
                    <div class="relative z-10">
                        <div class="mb-8 flex items-center w-full">
                            <div class="flex-1 text-right pr-4">
                                <h3 class="font-semibold">Commande passée</h3>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1 pl-4"></div>
                        </div>
                        <div class="mb-8 flex items-center w-full">
                            <div class="flex-1 text-right pr-4"></div>
                            <div class="w-8 h-8 bg-{{ $order->status != 'pending' ? 'blue-500' : 'gray-300' }} rounded-full flex items-center justify-center">
                                @if($order->status != 'pending')
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 pl-4">
                                <h3 class="font-semibold">En cours de traitement</h3>
                                <p class="text-sm text-gray-500">{{ $order->status != 'pending' ? 'Traitement terminé' : 'En attente' }}</p>
                            </div>
                        </div>
                        <div class="mb-8 flex items-center w-full">
                            <div class="flex-1 text-right pr-4">
                                <h3 class="font-semibold">En transit</h3>
                                <p class="text-sm text-gray-500">{{ $trackingInfo['status'] === 'In Transit' ? $trackingInfo['location'] : 'Pas encore expédié' }}</p>
                            </div>
                            <div class="w-8 h-8 bg-{{ $trackingInfo['status'] === 'In Transit' ? 'blue-500' : 'gray-300' }} rounded-full flex items-center justify-center">
                                @if($trackingInfo['status'] === 'In Transit')
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 pl-4"></div>
                        </div>
                        <div class="flex items-center w-full">
                            <div class="flex-1 text-right pr-4"></div>
                            <div class="w-8 h-8 bg-{{ $order->status === 'completed' ? 'blue-500' : 'gray-300' }} rounded-full flex items-center justify-center">
                                @if($order->status === 'completed')
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 pl-4">
                                <h3 class="font-semibold">Livré</h3>
                                <p class="text-sm text-gray-500">{{ $order->status === 'completed' ? 'Commande livrée' : 'En attente de livraison' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('client.orders.show', $order->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Retour aux détails de la commande
            </a>
            <a href="{{ route('client.orders.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Toutes mes commandes
            </a>
        </div>
    </div>
</div>
@endsection
