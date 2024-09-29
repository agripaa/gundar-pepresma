<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\ListFooter;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function create()
    {
        $footerCount = Footer::count();

        if ($footerCount >= 5) {
            return redirect()->route('manage-visitor')->with('error', 'Maximum of 5 footers allowed.');
        }

        return view('create-footer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_footer' => 'required|string|max:100',
            'list_footer.*.name_list' => 'required|string|max:100',
        ]);

        // Create Footer
        $footer = Footer::create(['title_footer' => $request->title_footer]);

        // Create List Footers
        foreach ($request->list_footer as $list) {
            ListFooter::create([
                'name_list' => $list['name_list'],
                'link' => $list['link'] ?? null,
                'footer_id' => $footer->id,
            ]);
        }

        return redirect()->route('manage-visitor')->with('success', 'Footer created successfully!');
    }
}
