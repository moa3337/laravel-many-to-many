<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::orderBy('updated_at', 'DESC')->paginate(10);
        //$types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = new Type();
        return view('admin.types.form', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'label' => 'required|string|max:25',
                'color' => 'required|string|size:7',
            ],
            [
                'label.required' => 'La label è obbligatoria',
                'label.string' => 'La label deve essere una stringa',
                'label.max' => 'La label non può avere più di 25 caratteri',
                'color.required' => 'Il colore è obbligatorio',
                'color.string' => 'Il colore deve essere una stringa',
                'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri (es. #ffffff)',
            ]
        );

        $type = new Type();
        $type->fill($request->all());
        $type->save();

        return to_route('admin.types.index')
            ->with('message', "Tipologia $type->id creata con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.index', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate(
            [
                'label' => 'required|string|max:25',
                'color' => 'required|string|size:7',
            ],
            [
                'label.required' => 'La label è obbligatoria',
                'label.string' => 'La label deve essere una stringa',
                'label.max' => 'La label non può avere più di 25 caratteri',
                'color.required' => 'Il colore è obbligatorio',
                'color.string' => 'Il colore deve essere una stringa',
                'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri (es. #ffffff)',
            ]
        );

        $type->update($request->all());

        return to_route('admin.types.index')
            ->with('message', "Tipologia $type->id modificata con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type_id = $type->id;
        $type->delete();
        return to_route('admin.types.index')
            - with('message')
            - with('message', "Tipologia $type_id eliminata!");
    }
}
