<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(15);

        return view('admin.pages.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.pages.contact.contact_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'instagram' => 'nullable|string',
        ]);

        $contact = new Contact([
            'phone' => $request->phone,
            'instagram' => $request->instagram,
        ]);

        $contact->save();

        return redirect()->route('contacts')->with('success', 'Каталог успешно создан');
    }

    public function edit(Contact $contact)
    {
        return view('admin.pages.contact.contact_edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update([
            'phone' => $request->phone,
            'instagram' => $request->instagram,
        ]);

        $contact->save();

        return redirect()->route('contacts')->with('success', 'Успешно изменен');
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts')->with('success', 'Успешно удален');
    }
}
