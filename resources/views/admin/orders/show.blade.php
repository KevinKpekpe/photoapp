@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Détails de la commande #{{ $order->id }}</h1>

    <h2>Informations client</h2>
    <p>Nom: {{ $order->user->name }}</p>
    <p>Email: {{ $order->user->email }}</p>

    <h2>Détails de la commande</h2>
    <p>Statut: {{ $order->status }}</p>
    <p>Total: {{ $order->total }}</p>

    <h2>Articles commandés</h2>
    <ul>
    @foreach($order->orderItems as $item)
        <li>{{ $item->product->name }} - Quantité: {{ $item->quantity }} - Prix: {{ $item->price }}</li>
    @endforeach
    </ul>

    <h2>Paiements</h2>
    @if($order->payments->isNotEmpty())
        <ul>
        @foreach($order->payments as $payment)
            <li>
                Montant: {{ $payment->amount }} -
                Méthode: {{ $payment->payment_method }} -
                Statut: {{ $payment->payment_status }} -
                Date: {{ $payment->created_at->format('d/m/Y H:i') }}
            </li>
        @endforeach
        </ul>
    @else
        <p>Aucun paiement enregistré pour cette commande.</p>
    @endif

    @if($order->payment)
        <h3>Dernier paiement</h3>
        <p>Montant: {{ $order->payment->amount }}</p>
        <p>Méthode: {{ $order->payment->payment_method }}</p>
        <p>Statut: {{ $order->payment->payment_status }}</p>
    @endif
</div>
@endsection
