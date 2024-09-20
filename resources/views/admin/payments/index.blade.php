@extends('admin.base')
@section('content')
<div class="flex-1 overflow-y-auto">
    <!-- Top Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Liste des paiements</h2>
        </div>
    </nav>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded-lg shadow-md m-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="p-4 bg-white shadow-md">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.payments.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Rechercher un paiement..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                <button type="submit" class="absolute left-3 top-2 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Payments List -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
            @if($payments->isEmpty())
                <div class="text-center text-gray-600">
                    Aucun paiement n'est disponible dans la base de données.
                </div>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="pb-3">Code</th>
                            <th class="pb-3">Commande</th>
                            <th class="pb-3">Montant</th>
                            <th class="pb-3">Méthode</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr class="border-b">
                                <td class="py-3">{{ $payment->code }}</td>
                                <td>{{ $payment->order->code ?? 'N/A' }}</td>
                                <td>{{ number_format($payment->amount, 2) }} €</td>
                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                <td>
                                    @if($payment->payment_status == 'paid')
                                        <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-sm">Payé</span>
                                    @elseif($payment->payment_status == 'unpaid')
                                        <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full text-sm">Non payé</span>
                                    @else
                                        <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full text-sm">Remboursé</span>
                                    @endif
                                </td>
                                <td class="flex space-x-2">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="inline-block">
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
        {{ $payments->links() }}
    </div>
</div>
@endsection
