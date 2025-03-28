<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Dish;
use Illuminate\Support\Str;

class BasketController extends Controller
{
    public function index()
    {
        //
    }
    public function addToBasket(Request $request)
    {
        $validated = $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $guestId = $request->cookie('guest_id') ?? Str::uuid()->toString();

        $dish = Dish::find($validated['dish_id']);

        $basketItem = Basket::updateOrCreate(
            ['guest_id' => $guestId, 'dish_id' => $validated['dish_id']],
            ['quantity' => $validated['quantity'], 'total_price' => $validated['quantity'] * $dish->price]
        );

        return response()->json(['success' => true, 'basket' => $basketItem])->cookie('guest_id', $guestId, 60 * 24 * 30);
    }
}
