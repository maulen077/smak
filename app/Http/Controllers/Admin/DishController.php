<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::paginate(15);

        return view('admin.pages.dish.index', compact('dishes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.dish.dish_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'name_kk' => 'required|string',
            'name_en' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|string',
            'description' => 'required|string',
            'description_kk' => 'required|string',
            'description_en' => 'required|string',
            'weight' => 'required|string',
        ]);

        $dish = new Dish([
            'name' => $request->name,
            'name_kk' => $request->name_kk,
            'name_en' => $request->name_en,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'description_kk' => $request->description_kk,
            'description_en' => $request->description_en,
            'weight' => $request->weight,
        ]);

        if ($request->file('photo')) {
            $dir = 'dish/image';
            $file = $request->file('photo');
            $file_name = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs($dir, $file_name, 'public');

            $dish->photo = url('storage/' . $file_path);
        }

        $dish->save();

        return redirect()->route('dishes')->with('success', 'Меню успешно создан');
    }

    public function edit(Dish $dish)
    {
        return view('admin.pages.dish.dish_edit', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {

        $dish->update([
            'name' => $request->name,
            'name_kk' => $request->name_kk,
            'name_en' => $request->name_en,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'description_kk' => $request->description_kk,
            'description_en' => $request->description_en,
            'weight' => $request->weight,
        ]);

        if ($request->file('photo')) {
            $dir = 'dish/image';
            $file = $request->file('photo');
            $file_name = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs($dir, $file_name, 'public');

            $dish->photo = url('storage/' . $file_path);
        }

        $dish->save();

        return redirect()->route('dishes')->with('success', 'Успешно изменен');
    }

    public function delete(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('dishes')->with('success', 'Успешно удален');
    }

    public function recommend(Request $request, int $id)
    {
        $dish = Dish::findOrFail($id);

        // Переключаем статус is_recommend (true ⇄ false)
        $dish->is_recommend = !$dish->is_recommend;
        $dish->save();

        return redirect()->back()->with('success', 'Статус рекомендации изменен!');
    }
}
