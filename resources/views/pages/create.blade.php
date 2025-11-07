@extends('layouts.app')
@section('content')

<h1 class="text-2xl font-bold pb-0">Create New Page</h1>

<form action="{{ route('pages.store') }}" method="POST" id="formBuilderForm">
    @csrf
    <input type="hidden" name="title" id="pageTitle" value="Untitled Page">
    <input type="hidden" name="gjs_html" id="pageHtml">
    <input type="hidden" name="gjs_css" id="pageCss">
    <input type="hidden" name="gjs_json" id="pageJson">

    <div class="pt-3 pb-6">
        <input type="text" class="text-xl font-semibold w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none"
               placeholder="Enter page title..."
               oninput="document.getElementById('pageTitle').value = this.value || 'Untitled Page'">
    </div>

    <div id="gjs" class="border-2 w-auto border-gray-300 rounded-lg overflow-hidden"></div>

    <div class="p-6">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-md">
            Save Page
        </button>
    </div>
</form>

@if(isset($page))
    <textarea id="saved-json" hidden>{{ $page->json }}</textarea>
@endif


@vite(['resources/js/app.js'])
<script>
function setEditorFields() {
    const editor = window.editor;
    if (!editor) return false;
    const projectData = editor.getProjectData();
    const formattedData = {
        "page_data": {
        
            "gjs-html": editor.getHtml() || '',
            "gjs-css": editor.getCss() || '',  
            "gjs-assets": JSON.stringify(projectData.assets || []),
            "gjs-styles": JSON.stringify(projectData.styles || []),
            "gjs-components": JSON.stringify(projectData.components || []),
        }
    };
    document.getElementById("pageJson").value = JSON.stringify(formattedData);

    document.getElementById("pageHtml").value = formattedData.page_data["gjs-html"];
    document.getElementById("pageCss").value = formattedData.page_data["gjs-css"];

    return true;
}

document.getElementById("formBuilderForm").addEventListener('submit', function (e) {
    if (setEditorFields()) return;
    e.preventDefault();
    const form = this;
    const interval = setInterval(() => {
        if (setEditorFields()) {
            clearInterval(interval);
            form.submit();
        }
    }, 100);
});
</script>
@endsection