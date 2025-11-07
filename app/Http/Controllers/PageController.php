<?php

// namespace App\Http\Controllers;

// use App\Models\Page;
// use Dotlogics\Grapesjs\App\Traits\EditorTrait;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;

// class PageController extends Controller
// {
//     use EditorTrait;

//     public function index()
//     {
//         $pages = Page::paginate();

//         return view('pages', compact('pages'));
//     }

//     public function create()
//     {
//         return view('pages.create');
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'title' => 'required|string|max:255',
//             'gjs_html' => 'nullable|string',
//             'gjs_css' => 'nullable|string',
//             'gjs_json' => 'nullable|string',
//         ]);
//         $slug = Str::slug($request->input('title'));
//         $page = Page::create([
//             'title' => $data['title'],
//             'slug' => $slug,
//             'html' => $data['gjs_html'] ?? '',
//             'css' => $data['gjs_css'] ?? '',
//             'json' => $data['gjs_json'] ?? '',
//         ]);

//         return redirect()->route('pages')->with('success', 'Page created.');
//     }

//     public function edit($id)
//     {
//         $page = Page::findOrFail($id);

//         return view('pages.edit', compact('page'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'page_json' => 'required|string',
//         ]);

//         $page = Page::findOrFail($id);

//         $page->title = $request->title;
//         $page->json = $request->page_json;

//         $page->save();

//         return redirect()->route('pages')->with('success', 'Page updated successfully');
//     }

//     public function show($slug)
//     {
//         $page = Page::where('slug', $slug)->firstOrFail();
//         $data = json_decode($page->json, true);

//         $finalHtml = $data['page_data']['gjs-html'] ?? '';

//         $finalCss = $data['page_data']['gjs-css'] ?? '';

//         $finalHtml = str_replace(['<body>', '</body>'], '', $finalHtml);

//         if (empty($finalHtml)) {
//             $finalHtml = '<h1>Page Content Not Found.</h1><p>Please edit this page and add content.</p>';
//         }

//         return view('pages.render', compact('finalHtml', 'finalCss', 'page'));
//     }

//     private function buildHtml(array $components): string
//     {
//         $html = '';
//         foreach ($components as $component) {
//             $tag = $component['type'] ?? 'div';
//             $content = $component['content'] ?? '';
//             $html .= "<{$tag}>{$content}</{$tag}>\n";
//         }

//         return $html;
//     }

//     private function buildCss(array $styles): string
//     {
//         $css = '';
//         foreach ($styles as $style) {
//             $selector = $style['selector'] ?? '';
//             if (! $selector) {
//                 continue;
//             }

//             $props = $style['props'] ?? [];
//             if (empty($props)) {
//                 continue;
//             }

//             $css .= "{$selector} {\n";
//             foreach ($props as $key => $value) {
//                 $css .= "    {$key}: {$value};\n";
//             }
//             $css .= "}\n";
//         }

//         return $css;
//     }
// }

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\ShortcodeService;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use EditorTrait;

    protected $shortcodeService;

    public function __construct(ShortcodeService $shortcodeService)
    {
        $this->shortcodeService = $shortcodeService;
    }

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
        $slug = Str::slug($request->input('title'));
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
            'page_json' => 'required|string',
        ]);

        $page = Page::findOrFail($id);

        $page->title = $request->title;
        $page->json = $request->page_json;

        $page->save();

        return redirect()->route('pages')->with('success', 'Page updated successfully');
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = json_decode($page->json, true);

        $finalHtml = $data['page_data']['gjs-html'] ?? '';
        $finalCss = $data['page_data']['gjs-css'] ?? '';

        $finalHtml = $this->shortcodeService->parse($finalHtml);

        $finalHtml = str_replace(['<body>', '</body>'], '', $finalHtml);

        if (empty($finalHtml)) {
            $finalHtml = '<h1>Page Content Not Found.</h1><p>Please edit this page and add content.</p>';
        }

        return view('pages.render', compact('finalHtml', 'finalCss', 'page'));
    }

    private function buildHtml(array $components): string
    {
        $html = '';
        foreach ($components as $component) {
            $tag = $component['type'] ?? 'div';
            $content = $component['content'] ?? '';
            $html .= "<{$tag}>{$content}</{$tag}>\n";
        }

        return $html;
    }

    private function buildCss(array $styles): string
    {
        $css = '';
        foreach ($styles as $style) {
            $selector = $style['selector'] ?? '';
            if (! $selector) {
                continue;
            }

            $props = $style['props'] ?? [];
            if (empty($props)) {
                continue;
            }

            $css .= "{$selector} {\n";
            foreach ($props as $key => $value) {
                $css .= "    {$key}: {$value};\n";
            }
            $css .= "}\n";
        }

        return $css;
    }
}
