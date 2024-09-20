@extends('admin.base')

@section('content')
<div class="flex-1 overflow-y-auto">
    <!-- Top Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Détails du paiement</h2>
            <a href="{{ route('admin.payments.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-full text-sm hover:bg-gray-600 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
            </a>
        </div>
    </nav>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded-lg shadow-md m-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Payment Details -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Informations de paiement</h3>
                    <p><strong>Code:</strong> {{ $payment->code }}</p>
                    <p><strong>Montant:</strong> {{ number_format($payment->amount, 2) }} €</p>
                    <p><strong>Méthode:</strong> {{ ucfirst($payment->payment_method) }}</p>
                    <p><strong>Statut:</strong>
                        @if($payment->payment_status == 'paid')
                            <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-sm">Payé</span>
                        @elseif($payment->payment_status == 'unpaid')
                            <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full text-sm">Non payé</span>
                        @else
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full text-sm">Remboursé</span>
                        @endif
                    </p>
                    <p><strong>ID de transaction:</strong> {{ $payment->transaction_id ?? 'N/A' }}</p>
                    <p><strong>Date de création:</strong> {{ $payment->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Informations de commande</h3>
                    @if($payment->order)
                        <p><strong>Code de commande:</strong> {{ $payment->order->code }}</p>
                        <p><strong>Statut de commande:</strong> {{ ucfirst($payment->order->status) }}</p>
                        <p><strong>Total de la commande:</strong> {{ number_format($payment->order->total, 2) }} €</p>
                        <!-- Ajoutez d'autres détails de commande si nécessaire -->
                    @else
                        <p>Aucune commande associée à ce paiement.</p>
                    @endif
                </div>
            </div>

            <!-- Update Payment Status Form -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Mettre à jour le statut du paiement</h3>
                <form action="{{ route('admin.payments.update-status', $payment) }}" method="POST" class="flex items-center">
                    @csrf
                    <select name="payment_status" class="form-select mr-2">
                        <option value="paid" {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>Payé</option>
                        <option value="unpaid" {{ $payment->payment_status == 'unpaid' ? 'selected' : '' }}>Non payé</option>
                        <option value="refunded" {{ $payment->payment_status == 'refunded' ? 'selected' : '' }}>Remboursé</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
