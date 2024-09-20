<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order with related data.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Order $order)
    {
        // Load related models to the order
        $order->load('user', 'orderItems.product', 'payments', 'payment');

        // Return the view with the order data
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update($validatedData);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Statut de la commande mis à jour avec succès.');
    }
}
