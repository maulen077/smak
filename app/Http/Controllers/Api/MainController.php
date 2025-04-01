<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Contact;

class MainController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();

        $categories = Category::all()->map(function ($category) use ($locale) {
            $category->name = $category->{"name_{$locale}"} ?? $category->name;
            return $category;
        });

        $banners = Banner::all();

        $dishes = Dish::all()->map(function ($dish) use ($locale) {
            $dish->name = $dish->{"name_{$locale}"} ?? $dish->name;
            $dish->description = $dish->{"description_{$locale}"} ?? $dish->description;
            return $dish;
        });

        $randomDishes = $dishes->isNotEmpty() ? $dishes->random(min(4, $dishes->count())) : collect();

        // Финальное выбранное блюдо после "кручения"
        $finalDish = $randomDishes->isNotEmpty() ? $randomDishes->random() : null;

        $recommend = Dish::where('is_recommend', true)->get()->map(function ($dish) use ($locale) {
            $dish->name = $dish->{"name_{$locale}"} ?? $dish->name;
            $dish->description = $dish->{"description_{$locale}"} ?? $dish->description;
            return $dish;
        });

        return view('web.index', compact('categories', 'banners', 'dishes', 'randomDishes', 'recommend', 'finalDish'));
    }

    public function contact()
    {
        $contact = Contact::whereNotNull('instagram')->where('instagram', '!=', '')->first();
        return view('web.contacts', compact('contact'));
    }
}
