<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - Commande #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-white font-sans">
    <div class="max-w-4xl mx-auto my-10">
        <header class="text-center py-6 bg-gray-800 text-white print:bg-gray-800">
            <h1 class="text-3xl font-bold">PhotoSop</h1>
        </header>
        <main class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-gray-800 pb-2">
                Facture - Commande #{{ $order->id }}
            </h2>
            <div class="flex flex-wrap -mx-4 mb-8">
                <div class="w-full md:w-1/2 px-4 mb-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Informations client</h3>
                    <p>Nom : {{ $order->user->name }}</p>
                    <p>Email : {{ $order->user->email }}</p>
                    <!-- Ajoutez d'autres informations client si disponibles -->
                </div>
                <div class="w-full md:w-1/2 px-4 mb-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Détails de la commande</h3>
                    <p>Numéro de commande : {{ $order->id }}</p>
                    <p>Date de commande : {{ $order->created_at->format('d/m/Y') }}</p>
                    <p>Statut : {{ $order->status }}</p>
                </div>
            </div>
            <table class="w-full mb-8">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-2 px-4 text-left">Produit</th>
                        <th class="py-2 px-4 text-left">Quantité</th>
                        <th class="py-2 px-4 text-left">Prix unitaire</th>
                        <th class="py-2 px-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $item->product->title }}</td>
                        <td class="py-2 px-4">{{ $item->quantity }}</td>
                        <td class="py-2 px-4">{{ number_format($item->price, 2) }} €</td>
                        <td class="py-2 px-4">{{ number_format($item->quantity * $item->price, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-b">
                        <td colspan="3" class="py-2 px-4 font-semibold">Total</td>
                        <td class="py-2 px-4">{{ number_format($order->total, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </main>
        <footer class="text-center py-6 bg-gray-800 text-white print:bg-gray-800">
            <p>Merci pour votre achat chez PhotoSop.</p>
        </footer>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
