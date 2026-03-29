<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Quote;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', __('messages.contact_success'));
    }

    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'project_type' => 'required|string|max:255',
            'project_description' => 'required|string',
            'budget_range' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable|string',
        ]);

        Quote::create($validated);

        return back()->with('success', __('messages.quote_success'));
    }
}
