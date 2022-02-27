<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;

use App\Models\Form;
use App\Models\FormElement;
use Auth;

class FormController extends Controller
{
    //

    public function index()
    {

        $forms = Form::where('status', 1)->get();

        if(Auth::check())
        {
            return View::make("forms.index", compact('forms'));
        }
        else
        {
            return View::make("forms.index_guest", compact('forms'));
        }


    }

    public function create()
    {
        return View::make("forms.create");
    }

    public function store(Request $request)
    {

            $form_datas = $request->form_data;

            $form           = new Form;
            $form->name     = $request->main_form_name;
            $form->status   = 1;
            $form->save();

            foreach($form_datas as $form_data)
            {

                $formElement                = new FormElement;
                $formElement->label         = $form_data['label'];
                $formElement->name          = $form_data['name'];
                $formElement->type          = $form_data['type'];
                $formElement->form_id       = $form->id;

                if($form_data['type'] == 'select')
                {

                    $formElement->options   = $form_data['options'];

                }

                $formElement->save();

            }

            return response()->json(['message' => 'Form saved successfully.']);

    }

    public function show($id)
    {

        $forms = Form::where('id', $id)->with('formElements')->first();
        return View::make("forms.show", compact('forms'));

    }

    public function delete(Request $request)
    {

        $form           = Form::find($request->item);
        $form->status   = 0;
        $form->save();
        return redirect()->route('dashboard');

    }
}
