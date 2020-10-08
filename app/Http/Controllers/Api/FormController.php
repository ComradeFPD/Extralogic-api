<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Resources\FormResource;
use App\Models\Form;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $forms = Form::all();
        return response()->json(FormResource::collection($forms), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFormRequest  $request
     *
     * @return JsonResponse
     */
    public function store(StoreFormRequest $request)
    {
        Form::create($request->all());
        return response()->json('', 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $form = Form::find($id);
        if(!$form){
            return response()->json('Такой формы не существует', 404);
        }
        return response()->json($form, 200);
    }

}
