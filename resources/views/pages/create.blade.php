
@extends('layouts.app')
<link rel="stylesheet" href="path/to/grapes.min.css" />
@section('content')


<link rel="stylesheet" href="path/to/grapes.min.css" />


<h1 class="text-2xl font-bold pb-0">Create New Page</h1>

<form action="{{ route('pages.store') }}" method="POST" id="formBuilderForm">
    @csrf

    <input type="hidden" name="title" value="Untitled Page" id="pageTitle">
    <input type="hidden" name="gjs_html" id="pageHtml">      
    <input type="hidden" name="gjs_css" id="pageCss">        
    <input type="hidden" name="gjs_json" id="pageJson">      


    <div class=" pt-3 pb-6">
        <input type="text"
               class="text-xl font-semibold w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none"
               placeholder="Enter page title..."
               oninput="document.getElementById('pageTitle').value = this.value || 'Untitled Page'">
    </div>

   
    <div id="gjs"></div>


    <div class="p-6 pt-3">
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition">
            Save
        </button>
    </div>
</form>


@vite(['resources/js/app.js']) 

<script>

window.editor = grapesjs.init({
    container: '#gjs',
  
    components: '<div class="txt-red">Hello world!</div>',
    style: '.txt-red{color: red}',

});


document.getElementById("formBuilderForm").addEventListener("submit", function(e) {
    
    if (typeof window.editor === 'undefined') {
        console.error("GrapesJS editor is not initialized.");
      
        return; 
    }

    const innerHtml = window.editor.getHtml();
    const cssContent = window.editor.getCss();
    const jsonContent = JSON.stringify(window.editor.getProjectData());
   
    const wrappedHtml = `<body>${innerHtml.trim()}</body>`; 
    
    
    document.getElementById("pageHtml").value = wrappedHtml;
    document.getElementById("pageCss").value = cssContent;
    document.getElementById("pageJson").value = jsonContent;
    
 
});
</script>

@endsection