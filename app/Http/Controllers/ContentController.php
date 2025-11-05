<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'shortcode' => 'required',
        ]);

        $slug = Str::slug($request->title);
        if (Content::where('slug', $slug)->exists()) {
            $slug .= '-'.time();
        }

        Content::create([
            'title' => $request->title,
            'slug' => $slug,
            'shortcode' => $request->shortcode,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Content saved!');
    }

    public function show($slug)
    {
        $content = Content::where('slug', $slug)->firstOrFail();

        $output = do_shortcode($content->shortcode);

        return view('contents.show', compact('output'));
    }
}
