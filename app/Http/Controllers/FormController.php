<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Quote;
use App\Mail\NewContactNotification;
use App\Mail\NewQuoteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $contact = Contact::create($validated);

        // Send email notification
        try {
            $adminEmail = env('ADMIN_EMAIL', 'admin@admin.com');
            Mail::to($adminEmail)->send(new NewContactNotification($contact));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email: ' . $e->getMessage());
        }

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

        $quote = Quote::create($validated);

        // Send email notification
        try {
            $adminEmail = env('ADMIN_EMAIL', 'admin@admin.com');
            Mail::to($adminEmail)->send(new NewQuoteNotification($quote));
        } catch (\Exception $e) {
            \Log::error('Failed to send quote email: ' . $e->getMessage());
        }

        return back()->with('success', __('messages.quote_success'));
    }
}
