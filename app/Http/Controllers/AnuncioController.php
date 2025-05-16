<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Felino;
use Illuminate\Http\Request;
use App\Http\Requests\AdverFeline;
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
    public function create($feline)
    {
        $feline = Felino::find($feline);
        return view('advertisement.create', compact('feline'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdverFeline $request)
    {

        $advertisement = new Anuncio();
        $advertisement->title = $request->input('title');
        $advertisement->type = $request->input('type');
        $advertisement->description = $request->input('description');
        $advertisement->id_felino = $request->input('feline_id');

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
    public function edit(Anuncio $anuncio)
    {
        return view('advertisement.edit', ['anuncio' => $anuncio]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anuncio $anuncio)
    {
        $anuncio->title = $request->input('title');
        $anuncio->type = $request->input('type');
        $anuncio->description = $request->input('description');
        $anuncio->id_felino = $request->input('feline_id');

        $anuncio->save();

        return redirect()->route('adver.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(anuncio $anuncio)
    {
        $anuncio->delete();
        return redirect()->route('adver.index');
    }
}
