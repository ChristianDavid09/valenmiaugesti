<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Felino;
use Illuminate\Http\Request;
use App\Http\Requests\FormFeline;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anuncios = Anuncio::all();
        return view('advertisement.index', compact('anuncios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $felines = Felino::All();
        return view('advertisement.create', compact('felines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormFeline $request)
    {

        $advertisement = new Anuncio();
        $advertisement->titulo = $request->input('title');
        $advertisement->tipo = $request->input('type');
        $advertisement->descripcion = $request->input('description');
        $advertisement->id_felino = $request->input('feline');;

        $advertisement->save();

        return redirect()->route('index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(anuncio $anuncio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(anuncio $anuncio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, anuncio $anuncio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(anuncio $anuncio)
    {
        //
    }
}
