<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;

class FormController extends Controller
{
    use EditorTrait;

    public function index()
    {
        $forms = Form::paginate();

        return view('forms', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'form_json' => 'required|string',
        ]);

        $form = new Form;
        $form->title = $request->title;
        $form->json = $request->form_json;
        $form->save();

        return redirect()->route('forms')->with('success', 'Form saved successfully');
    }

    public function edit($id)
    {
        $form = Form::findOrFail($id);

        return view('forms.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'form_json' => 'required|string',
        ]);

        $form = Form::findOrFail($id);
        $form->title = $request->title;
        $form->json = $request->form_json;
        $form->save();

        return redirect()->route('forms')->with('success', 'Form updated successfully');
    }
}
