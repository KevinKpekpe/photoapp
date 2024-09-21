@extends('clients.base')
@section('content')
    <!-- Dashboard Content -->
    <div class="container mx-auto px-4 py-8 flex">
        @include('clients.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-8 animate-fade-in-up">Tableau de bord</h1>

            <!-- User Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 animate-fade-in-up">
                <h2 class="text-2xl font-semibold mb-4">Informations personnelles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Nom: <span class="font-semibold">{{ $user->name }} {{ $user->postnom }} {{ $user->prenom }}</span></p>
                        <p class="text-gray-600">Email: <span class="font-semibold">{{ $user->email }}</span></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Téléphone: <span class="font-semibold">{{ $user->telephone }}</span></p>
                        <p class="text-gray-600">Adresse: <span class="font-semibold">{{ $user->adresse }}</span></p>
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
                            @foreach($orders as $order)
                            <tr>
                                <td class="border px-4 py-2">#{{ $order->code }}</td>
                                <td class="border px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="border px-4 py-2">{{ number_format($order->total, 2) }} €</td>
                                <td class="border px-4 py-2">
                                    <span class="bg-{{ $order->status === 'completed' ? 'green' : ($order->status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $order->status === 'completed' ? 'green' : ($order->status === 'pending' ? 'yellow' : 'red') }}-800 px-2 py-1 rounded-full text-sm">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('client.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Voir détails</a>
                                    @if($order->status === 'pending')
                                        <a href="{{ route('client.orders.cancel', $order->id) }}" class="text-red-600 hover:text-red-800 mr-2" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande?')">Annuler</a>
                                    @endif
                                    <a href="{{ route('client.orders.track', $order->id) }}" class="text-green-600 hover:text-green-800">Suivre</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
