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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'gjs_html' => 'nullable|string',
            'gjs_css' => 'nullable|string',
            'gjs_json' => 'nullable|string',
        ]);

        $baseSlug = Str::slug($data['title'] ?? 'page');
        $slug = $baseSlug;
        $i = 1;
        while (Page::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$i++;
        }

        $page = Page::create([
            'title' => $data['title'],
            'slug' => $slug,
            'html' => $data['gjs_html'] ?? '',
            'css' => $data['gjs_css'] ?? '',
            'json' => $data['gjs_json'] ?? '',
        ]);

        return redirect()->route('pages')->with('success', 'Page created.');
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

    private function buildHtml($components)
    {
        if (! is_array($components)) {
            return '';
        }

        $html = '';
        foreach ($components as $comp) {
            // Skip non-component items
            if (! isset($comp['tagName']) && ! isset($comp['type'])) {
                continue;
            }

            // Text node
            if (($comp['type'] ?? '') === 'textnode') {
                $html .= htmlspecialchars($comp['content'] ?? '');

                continue;
            }

            // Default to div
            $tag = $comp['tagName'] ?? 'div';
            $classes = isset($comp['classes']) ? implode(' ', $comp['classes']) : '';
            $id = $comp['attributes']['id'] ?? '';

            // Recursively build inner content
            $inner = $this->buildHtml($comp['components'] ?? []);

            $attrs = '';
            if ($id) {
                $attrs .= " id=\"$id\"";
            }
            if ($classes) {
                $attrs .= " class=\"$classes\"";
            }

            $html .= "<$tag$attrs>$inner</$tag>";
        }

        return $html;
    }

    private function buildCss($styles)
    {
        $css = '';
        foreach ($styles ?? [] as $style) {
            $selectors = $style['selectors'] ?? [];
            $props = $style['style'] ?? [];

            $selector = '';
            foreach ($selectors as $s) {
                $name = $s['name'] ?? '';
                $type = $s['type'] ?? 1;
                $prefix = $type === 1 ? '.' : '#';
                $selector .= $prefix.$name;
            }

            if (! $selector || empty($props)) {
                continue;
            }

            $css .= "$selector {\n";
            foreach ($props as $key => $val) {
                $css .= "  $key: $val;\n";
            }
            $css .= "}\n";
        }

        return $css;
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = json_decode($page->json, true);

        $components = $data['pages'][0]['frames'][0]['component']['components'] ?? [];
        $styles = $data['styles'] ?? [];

        $finalHtml = $this->buildHtml($components);
        $finalCss = $this->buildCss($styles);

        return view('pages.render', compact('finalHtml', 'finalCss', 'page'));
    }
}
