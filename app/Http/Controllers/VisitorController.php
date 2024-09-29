<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Footer;
use App\Models\ListFooter;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $footers = Footer::with('listFooters')->get();
        $contactCount = Contact::count();
        $footerCount = Footer::count();
        return view('manage-visitor', compact('contacts', 'footers', 'contactCount', 'footerCount'));
    }

    // Contact CRUD operations
    public function createContact()
    {
        return view('create-contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'map_embed' => 'required',
        ]);

        Contact::create($request->only('alamat', 'no_telepon', 'email', 'map_embed'));

        return redirect()->route('manage-visitor')->with('success', 'Contact created successfully');
    }

    public function editContact($id)
    {
        $contact = Contact::findOrFail($id);
        return view('edit-contact', compact('contact'));
    }

    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'map_embed' => 'required',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->only('alamat', 'no_telepon', 'email', 'map_embed'));

        return redirect()->route('manage-visitor')->with('success', 'Contact updated successfully');
    }

    public function destroyContact($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('manage-visitor')->with('success', 'Contact deleted successfully');
    }

    // Footer CRUD operations
    public function createFooter()
    {
        return view('create-footer');
    }

    public function storeFooter(Request $request)
    {
        $request->validate([
            'title_footer' => 'required|string|max:100',
            'list_footer.*.name_list' => 'required|string|max:100',
        ]);

        $footer = Footer::create(['title_footer' => $request->title_footer]);

        foreach ($request->list_footer as $list) {
            ListFooter::create([
                'name_list' => $list['name_list'],
                'link' => $list['link'] ?? null,
                'footer_id' => $footer->id,
            ]);
        }

        return redirect()->route('manage-visitor')->with('success', 'Footer created successfully');
    }

    public function editFooter($id)
    {
        $footer = Footer::with('listFooters')->findOrFail($id);
        return view('edit-footer', compact('footer'));
    }

    public function updateFooter(Request $request, $id)
    {
        $request->validate([
            'title_footer' => 'required|string|max:100',
        ]);
    
        $footer = Footer::findOrFail($id);
        $footer->update(['title_footer' => $request->title_footer]);
    
        // Update existing list footers
        if ($request->has('list_footer')) {
            foreach ($request->list_footer as $footerItem) {
                if (isset($footerItem['id'])) {
                    ListFooter::where('id', $footerItem['id'])->update([
                        'name_list' => $footerItem['name_list'],
                        'link' => $footerItem['link'] ?? null,
                    ]);
                } else {
                    ListFooter::create([
                        'name_list' => $footerItem['name_list'],
                        'link' => $footerItem['link'] ?? null,
                        'footer_id' => $footer->id,
                    ]);
                }
            }
        }
    
        // Handle deleted list footers
        if ($request->has('delete_list_footer')) {
            ListFooter::whereIn('id', $request->delete_list_footer)->delete();
        }
    
        return redirect()->route('manage-visitor')->with('success', 'Footer updated successfully');
    }
    

    public function destroyFooter($id)
    {
        Footer::findOrFail($id)->delete();
        return redirect()->route('manage-visitor')->with('success', 'Footer deleted successfully');
    }
}
