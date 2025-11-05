{{-- resources/views/forms/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pt-0">
    <h1 class="text-2xl font-bold mb-6">Create New Form</h1>

    <div class="mb-6">
        <input type="text"
            class="text-xl font-semibold w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none"
            placeholder="Enter form title..."
            oninput="document.getElementById('pageTitle').value = this.value || 'Untitled Page'">
    </div>

   
    <div id="fb-editor" style="min-height: 500px;"></div>

    <form action="{{ route('forms.store') }}" method="POST" id="formBuilderForm" class="mt-3">
        @csrf
        <input type="hidden" name="title" value="Untitled Page" id="formTitle">
        <input type="hidden" name="form_json" id="formJson">
        
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition flex items-center gap-1">
            Save
        </button>
    </form>
</div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<script>
let fbEditor;

jQuery(function($) {
    fbEditor = $('#fb-editor').formBuilder(); 
});

document.getElementById('formBuilderForm').addEventListener('submit', function () {
    let formData = fbEditor.actions.getData('json'); 
    document.getElementById('formJson').value = formData;
});
</script>
@endsection
