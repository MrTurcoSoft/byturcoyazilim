<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived'
        ]);

        $contact->update(['status' => $validated['status']]);

        return back()->with('success', 'Durum güncellendi.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Mesaj silindi.');
    }
}
