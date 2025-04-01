<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Basket;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $guestId = $request->cookie('guest_id');

        //if (!$guestId) {
        //    return redirect()->route('order')->with('error', 'Ваша корзина пуста.');
        //}

        $basketItems = Basket::where('guest_id', $guestId)
            ->with('dish')
            ->get();

        $totalPrice = $basketItems->sum('total_price');

        $days = collect(range(0, 3))->map(function ($i) {
            $date = now()->addDays($i);
            return [
                'day' => $date->format('d'),
                'weekday' => __('menu.days.' . $date->format('D')),
            ];
        });

        $times = [
            '10:00 - 13:00',
            '14:00 - 17:00',
            '18:00 - 21:00',
        ];

        return view('web.basket', compact('basketItems', 'totalPrice', 'days', 'times'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'delivery_type' => 'nullable|string',
            'address' => 'nullable|string',
            'comment' => 'nullable|string',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|string',
            'cart' => 'nullable|string',
        ]);

        $guestId = $request->cookie('guest_id') ?? Str::uuid()->toString();
        $cartItems = json_decode($validated['cart'], true);

        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        $order = Order::create([
            'guest_id' => $guestId,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'delivery_type' => $validated['delivery_type'],
            'address' => $validated['address'],
            'comment' => $validated['comment'],
            'delivery_date' => $validated['delivery_date'],
            'delivery_time' => $validated['delivery_time'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dishes_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }

        return redirect()->route('menu')->with('success', 'Заказ создан!');
    }
}
