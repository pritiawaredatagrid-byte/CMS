<?php

namespace App\Http\Controllers;

use App\Models\Page;
use DOMDocument;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use EditorTrait;

    public function index()
    {
        $pages = Page::paginate();

        return view('pages', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

            'gjs_html' => 'required|string',
            'gjs_css' => 'required|string',
            'gjs_json' => 'required|string',
        ]);

        $slug = Str::slug($request->title);

        $page = Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'html' => $request->gjs_html,
            'css' => $request->gjs_css,
            'json' => $request->gjs_json,
        ]);

        return redirect()->route('pages')
            ->with('success', 'Page saved successfully!');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'html' => 'required|string',
            'css' => 'nullable|string',
            'page_json' => 'required|string',
        ]);

        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->html = $request->html;
        $page->css = $request->css;
        $page->json = $request->page_json;
        $page->save();

        return redirect()->route('pages')->with('success', 'Page updated successfully');
    }

    // public function show($slug)
    // {
    //     $page = Page::where('slug', $slug)->firstOrFail();
    //     dd([
    //         'raw_html' => $page->html,
    //         'raw_html_length' => strlen((string) $page->html),
    //         'css' => $page->css,
    //         'json' => $page->json,
    //     ]);
    //     $rawHtml = $page->html;
    //     $content = '';

    //     if (empty($rawHtml)) {
    //         $content = '<h1>Page Content Not Found.</h1><p>Please edit this page and add content.</p>';
    //     } else {

    //         $dom = new DOMDocument;

    //         @$dom->loadHTML($rawHtml, LIBXML_HTML_NODEFDTD);

    //         $body = $dom->getElementsByTagName('body')->item(0);

    //         if ($body) {

    //             foreach ($body->childNodes as $node) {
    //                 $content .= $dom->saveHTML($node);
    //             }
    //         } else {

    //             $content = $rawHtml;
    //         }
    //     }

    //     $globalDependencies = '';

    //     $fullHtml = '
    //     <!DOCTYPE html>
    //     <html lang="en">
    //     <head>
    //         <meta charset="UTF-8">
    //         <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //         <title>'.htmlspecialchars($page->title).'</title>

    //         '.$globalDependencies.'

    //         '.(! empty($page->css) ? '<style>'.$page->css.'</style>' : '').'

    //     </head>
    //     <body>
    //         '.$content.'
    //     </body>
    //     </html>
    // ';

    //     return new Response($fullHtml, 200, [
    //         'Content-Type' => 'text/html',
    //     ]);
    // }

    public function show($slug)
    {
        $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
        dd([

            'json' => $page->json,
        ]);
        $content = '';
        $styles = '';

        if (! empty($page->json)) {

            $data = json_decode($page->json, true);

            $mainComponent = $data['pages'][0]['frames'][0]['component'] ?? null;

            if (isset($mainComponent['content']) && is_string($mainComponent['content'])) {
                $content = $mainComponent['content'];
            }

            $styles = $data['styles'] ?? '';

            if (empty($content) && $mainComponent) {

                $content = '<h1>Page built from JSON structure, content may be missing.</h1>';
            }

        } else {

            $content = '<h1>Error: No content or JSON data available for this page.</h1>';
        }

        $globalDependencies = '';

        $fullHtml = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.htmlspecialchars($page->title).'</title>
            
            '.$globalDependencies.' 
            
            '.(! empty($styles) ? '<style>'.$styles.'</style>' : '').'
            
        </head>
        <body>
            '.$content.' 
        </body>
        </html>
    ';

        return new Response($fullHtml, 200, [
            'Content-Type' => 'text/html',
        ]);
    }
}
