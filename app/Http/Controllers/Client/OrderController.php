<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('clients.dashboard.dashboard', compact('orders', 'user'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('clients.dashboard.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            $order->save();
            return redirect()->route('client.orders.index')->with('success', 'Order cancelled successfully.');
        }

        return redirect()->route('client.orders.index')->with('error', 'This order cannot be cancelled.');
    }

    public function trackOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $trackingInfo = [
            'status' => 'In Transit',
            'location' => 'Kinshasa Distribution Center',
            'estimated_delivery' => now()->addDays(3)->format('Y-m-d'),
        ];

        return view('clients.dashboard.track', compact('order', 'trackingInfo'));
    }
}
