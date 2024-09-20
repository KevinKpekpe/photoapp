@extends('admin.base')

@section('content')
<div class="flex-1 overflow-y-auto">
    <!-- Top Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Liste des commandes</h2>
        </div>
    </nav>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded-lg shadow-md m-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Orders List -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
            @if($orders->isEmpty())
                <div class="text-center text-gray-600">
                    Aucune commande n'est disponible dans la base de données.
                </div>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="pb-3">Code</th>
                            <th class="pb-3">Client</th>
                            <th class="pb-3">Total</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3">Méthode de paiement</th>
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b">
                                <td class="py-3">{{ $order->code }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ number_format($order->total, 2) }} €</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full text-sm">En attente</span>
                                    @elseif($order->status == 'completed')
                                        <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-sm">Terminée</span>
                                    @else
                                        <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full text-sm">Annulée</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="flex space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 p-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
