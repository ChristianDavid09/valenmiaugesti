<?php

namespace App\Http\Controllers;

use App\Models\Felino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FelinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $felinos = Felino::all();
        return view('feline.index', compact('felinos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $feline = new Felino();
        $feline->nombre = $request->input('name');
        $feline->edad = $request->input('age');
        $feline->raza = $request->input('race');
        $feline->sexo = $request->input('sex');
        $feline->estado_salud = $request->input('health_status');
        $feline->id_colonia = Auth::user()->colonia->id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $photo = $request->file('image');
        
            $extension = $photo->getClientOriginalExtension();
            $filePhoto = $request->input('type') . '.' . $request->input('name') . '.' . $extension;
            
            
            $routeImage = public_path('colonias/images/anuncios');
        
            if (!file_exists($routeImage)) {
                mkdir($routeImage, 0777, true);
            }
        
            $photo->move($routeImage, $filePhoto);
            $felino->foto = $filePhoto;
        
        } 
        $felino->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(felino $felino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(felino $felino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, felino $felino)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(felino $felino)
    {
        //
    }
}
