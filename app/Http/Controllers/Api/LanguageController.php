<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        if (!in_array($locale, ['ru', 'kk', 'en'])) {
            $locale = 'ru';
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }

}
