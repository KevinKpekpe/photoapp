<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentOptions()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        $user = auth()->user();

        return view('clients.paiements.index', compact('cart', 'total', 'user'));
    }

    public function processPayment(Request $request)
    {
        try {
            $request->validate([
                'payment_method' => 'required|in:card,mobile,cash',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'address' => 'required|string',
            ]);

            $paymentMethod = $request->input('payment_method');
            $cart = session()->get('cart', []);
            $totalAmount = $this->calculateTotal($cart);

            if (empty($cart)) {
                throw new Exception('Votre panier est vide.');
            }

            $order = $this->createOrder($totalAmount, $paymentMethod);
            $this->createOrderItems($order, $cart);

            switch ($paymentMethod) {
                case 'card':
                    return $this->processCardPayment($order);
                case 'mobile':
                    return $this->processMobilePayment($order);
                case 'cash':
                    return $this->processCashPayment($order);
                default:
                    throw new Exception('Méthode de paiement non valide.');
            }
        } catch (Exception $e) {
            Log::error('Erreur de paiement: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    private function processCardPayment($order)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $lineItems = $this->prepareLineItems($order->orderItems);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'payment_method' => 'card',
                'payment_status' => 'unpaid',
                'transaction_id' => $session->id,
                'code' => Str::random(10),
            ]);

            return redirect($session->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error('Erreur Stripe: ' . $e->getMessage());
            throw new Exception('Erreur Stripe: ' . $e->getMessage());
        } catch (Exception $e) {
            Log::error('Erreur de paiement: ' . $e->getMessage());
            throw new Exception('Une erreur est survenue lors du traitement du paiement par carte: ' . $e->getMessage());
        }
    }

    private function processMobilePayment($order)
    {
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => 'mobile',
            'payment_status' => 'pending',
            'code' => Str::random(10),
        ]);

        return redirect()->route('payment.mobile.confirm', $order->id);
    }

    private function processCashPayment($order)
    {
        $order->update(['status' => 'pending']);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => 'cash',
            'payment_status' => 'pending',
            'code' => Str::random(10),
        ]);

        return redirect()->route('payment.cash.confirm', $order->id);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $payment = Payment::where('transaction_id', $sessionId)->firstOrFail();
        $order = $payment->order;

        $payment->update(['payment_status' => 'paid']);
        $order->update(['status' => 'completed']);

        session()->forget('cart');

        return view('clients.paiements.success', compact('order'));
    }

    public function cancel()
    {
        return view('clients.payment.cancel');
    }

    public function mobileConfirm($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('clients.payment.mobile_confirm', compact('order'));
    }

    public function cashConfirm($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('clients.payment.cash_confirm', compact('order'));
    }

    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    private function createOrder($totalAmount, $paymentMethod)
    {
        return Order::create([
            'user_id' => auth()->id(),
            'total' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $paymentMethod,
            'code' => Str::random(10),
        ]);
    }

    private function createOrderItems($order, $cart)
    {
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'code' => Str::random(10),
            ]);
        }
    }

    private function prepareLineItems($orderItems)
    {
        return $orderItems->map(function ($item) {
            $product = Product::findOrFail($item->product_id);
            return [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => (int)($item->price * 100),
                    'product_data' => [
                        'name' => $product->title ?? 'Produit inconnu',
                        'description' => $product->description ?? '',
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();
    }
}
