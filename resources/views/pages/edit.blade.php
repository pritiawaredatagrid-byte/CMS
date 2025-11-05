@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css"/>

<div class="container mx-auto p-6 pt-0">
    <h1 class="text-2xl font-bold mb-6">Edit Page</h1>

    <form action="{{ route('pages.update', $page->id) }}" method="POST" id="pageEditorForm">
        @csrf
        @method('PUT')

        <input type="hidden" name="title" value="{{ $page->title }}" id="pageTitle">
        <input type="hidden" name="html" id="pageHtml">
        <input type="hidden" name="css" id="pageCss">
        <input type="hidden" name="page_json" id="pageJson">

        <div class="mb-6">
            <input type="text"
                   class="text-xl font-semibold w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none"
                   value="{{ $page->title }}"
                   oninput="document.getElementById('pageTitle').value = this.value">
        </div>

        <div id="gjs" style="height:600px; border:1px solid #ddd;"></div>

        <button type="submit"
            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm">
            Update
        </button>
    </form>
</div>

<script src="https://unpkg.com/grapesjs"></script>

<script>
var editor = grapesjs.init({
    container: '#gjs',
    height: '600px',
    storageManager: false,
});


@if($page->json)
    editor.loadProjectData({!! $page->json !!});
@else
    editor.setComponents(`{!! $page->html !!}`);
    editor.setStyle(`{!! $page->css !!}`);
@endif

let isSubmitting = false;

function unloadHandler(e) {
   
    if (!isSubmitting && editor.getModel().get('changesCount') > 0) {
        e.preventDefault();
        e.returnValue = "";
    }
}


window.addEventListener("beforeunload", unloadHandler);

document.getElementById("pageEditorForm").addEventListener("submit", function() {
    isSubmitting = true;

    document.getElementById("pageHtml").value = editor.getHtml();
    document.getElementById("pageCss").value = editor.getCss();
    document.getElementById("pageJson").value = JSON.stringify(editor.getProjectData());

  
    editor.getModel().set('changesCount', 0);

    window.removeEventListener("beforeunload", unloadHandler);
});
</script>


@endsection

