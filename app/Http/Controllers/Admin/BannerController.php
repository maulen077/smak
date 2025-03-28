<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::paginate(15);

        return view('admin.pages.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.banner.banner_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $banner = new Banner([
            'name' => $request->name,
        ]);

        if ($request->file('photo')) {
            $dir = 'banner/image';
            $file = $request->file('photo');
            $file_name = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs($dir, $file_name, 'public');

            $banner->photo = url('storage/' . $file_path);
        }

        $banner->save();

        return redirect()->route('banners')->with('success', 'Баннер успешно создан');
    }


    public function delete(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners')->with('success', 'Успешно удален');
    }
}
