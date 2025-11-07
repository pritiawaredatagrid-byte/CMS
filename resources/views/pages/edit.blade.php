@extends('layouts.app')

@section('content')

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
@vite(['resources/js/app.js'])
<script>

const pageJsonData = @json(json_decode($page->json, true)); 


const gjsHtml = pageJsonData?.page_data?.['gjs-html'] || '';
const gjsCss = pageJsonData?.page_data?.['gjs-css'] || '';

function loadPageData(editor) {
    if (gjsHtml.length > 0) {
   
        const components = gjsHtml.replace(/<\/?body>/g, ''); 

        editor.setComponents(components);
        editor.setStyle(gjsCss);
        
        console.log('Content loaded using HTML/CSS strings.');
    } else {
        console.log('No content found in gjs-html/gjs-css. Loading empty editor.');
    }

    editor.getModel().set('changesCount', 0);
}


function waitForEditor() {
   
    if (typeof window.editor !== 'undefined') {
        loadPageData(window.editor);
        return;
    }
    
    setTimeout(waitForEditor, 100);
}

waitForEditor();



let isSubmitting = false;

function unloadHandler(e) {
    if (!isSubmitting && window.editor && window.editor.getModel().get('changesCount') > 0) {
        e.preventDefault();
        e.returnValue = "";
    }
}

window.addEventListener("beforeunload", unloadHandler);

document.getElementById("pageEditorForm").addEventListener("submit", function() {
    if (typeof window.editor === 'undefined') return;

    isSubmitting = true;


    const projectData = window.editor.getProjectData();
    document.getElementById("pageJson").value = JSON.stringify(projectData);

  
    const finalHtml = window.editor.getHtml();
    const finalCss = window.editor.getCss();

   
    const newPageJson = {
        'page_data': {
            'gjs-html': `<body>${finalHtml}</body>`,
            'gjs-css': finalCss,

            'gjs-assets': JSON.stringify(projectData.assets || []),
            'gjs-styles': JSON.stringify(projectData.styles || []),
            'gjs-components': JSON.stringify(projectData.components || []),
        }
    };


    document.getElementById("pageJson").value = JSON.stringify(newPageJson);
    window.editor.getModel().set('changesCount', 0);
    window.removeEventListener("beforeunload", unloadHandler);
});
</script>

@endsection