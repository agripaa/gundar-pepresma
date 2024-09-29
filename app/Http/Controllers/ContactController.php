<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        // Check if a Contact entry already exists
        $contact = Contact::first();

        // If a contact exists, disable the create button
        if ($contact) {
            return redirect()->route('manage-visitor')->with('error', 'Contact already exists, please edit the existing contact.');
        }

        return view('create-contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'map_embed' => 'required',
        ]);

        // Create contact record
        Contact::create($request->all());

        return redirect()->route('manage-visitor')->with('success', 'Contact created successfully!');
    }
}
