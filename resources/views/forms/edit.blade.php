@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pt-0">
    <h1 class="text-2xl font-bold mb-6">Edit Form</h1>


    <div class="mb-4">
        <input type="text" 
               class="text-xl font-semibold w-full border-b-2 border-gray-300 focus:border-blue-600 outline-none"
               value="{{ $form->title }}"
               oninput="document.getElementById('formTitle').value = this.value">
    </div>


    <div id="fb-editor" style="min-height: 500px;"></div>


    <form action="{{ route('forms.update', $form->id) }}" method="POST" id="formBuilderForm" class="mt-4">
        @csrf
        <input type="hidden" name="title" id="formTitle" value="{{ $form->title }}">
        <input type="hidden" name="form_json" id="formJson">

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm">
            Update Form
        </button>
    </form>
</div>

{{-- JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<script>
let fbEditor;

jQuery(function($) {
    fbEditor = $('#fb-editor').formBuilder({
        formData: `{!! $form->json !!}`
    });
});

document.getElementById('formBuilderForm').addEventListener('submit', function () {
    document.getElementById('formJson').value = fbEditor.actions.getData('json');
});
</script>
@endsection
