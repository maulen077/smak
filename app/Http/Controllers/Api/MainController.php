<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

        $randomDish = $dishes->isNotEmpty() ? $dishes->random() : null;

        $recommend = Dish::where('is_recommend', true)->get()->map(function ($dish) use ($locale) {
            $dish->name = $dish->{"name_{$locale}"} ?? $dish->name;
            $dish->description = $dish->{"description_{$locale}"} ?? $dish->description;
            return $dish;
        });

        return view('web.index', compact('categories', 'banners', 'dishes', 'randomDish', 'recommend'));
    }

    public function contact()
    {
        return view('web.contacts');
    }
}
