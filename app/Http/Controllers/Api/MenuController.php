<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Contact;
use Illuminate\Support\Facades\App;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $locale = App::getLocale();

        if ($request->has('category_id')) {
            $dishes = Dish::where('category_id', $request->category_id)->get();
        } else {
            $dishes = Dish::all();
        }

        $dishes->transform(function ($dish) use ($locale) {
            $dish->name = $dish["name_{$locale}"] ?? $dish->name;
            $dish->description = $dish["description_{$locale}"] ?? $dish->description;
            return $dish;
        });

        return view('web.menu', compact('categories', 'dishes'));
    }
    

}
