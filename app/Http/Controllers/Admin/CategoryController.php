<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);

        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_kk' => 'required|string',
            'name_en' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $category = new Category([
            'name' => $request->name,
            'name_kk' => $request->name_kk,
            'name_en' => $request->name_en,
        ]);

        if ($request->file('photo')) {
            $dir = 'category/image';
            $file = $request->file('photo');
            $file_name = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs($dir, $file_name, 'public');

            $category->photo = url('storage/' . $file_path);
        }

        $category->save();

        return redirect()->route('categories')->with('success', 'Каталог успешно создан');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.category_edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $category->update([
            'name' => $request->name,
            'name_kk' => $request->name_kk,
            'name_en' => $request->name_en,
        ]);

        if ($request->file('photo')) {
            $dir = 'catalog/image';
            $file = $request->file('photo');
            $file_name = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs($dir, $file_name, 'public');

            $category->photo = url('storage/' . $file_path);
        }

        $category->save();

        return redirect()->route('categories')->with('success', 'Успешно изменен');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('success', 'Успешно удален');
    }
}
