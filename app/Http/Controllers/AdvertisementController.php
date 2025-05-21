<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Feline;
use Illuminate\Http\Request;
use App\Http\Requests\AdverFeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cologneId = Auth::user()->cologne->id;

        // Cogemos solo los anuncios cuyo felino pertenece a esa colonia
        /**
         * La función whereHas() permite filtrar los anuncios de una consulta Eloquent basandose en la
         * existencia de una relacion que cumpla ciertas condiciones.
         *
         * Este filtro sería equivalente a esta consulta SQL:
         *
         * SELECT anuncios.*, felinos.*
         * FROM anuncios
         * JOIN felinos ON anuncios.felino_id = felinos.id
         * WHERE felinos.id_colonia = (id de la colonia del usuario logueado)
         */

        $advertisements = Advertisement::whereHas('feline', function($query) use ($cologneId) {
            $query->where('id_cologne', $cologneId);
        })->with('feline')->get();

        return view('advertisement.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($feline)
    {
        $feline = Feline::find($feline);
        return view('advertisement.create', compact('feline'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdverFeline $request)
    {

        $advertisement = new Advertisement();
        $advertisement->title = $request->input('title');
        $advertisement->type = $request->input('type');
        $advertisement->description = $request->input('description');
        $advertisement->id_feline = $request->input('feline_id');

        $advertisement->save();

        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $adver): View
    {
        return view('advertisement.show', ['advertisement' => $adver]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $adver)
    {

        return view('advertisement.edit', ['advertisement' => $adver]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $adver)
    {
        $adver->title = $request->input('title');
        $adver->type = $request->input('type');
        $adver->description = $request->input('description');
        $adver->id_feline = $request->input('feline_id');

        $adver->save();

        return redirect()->route('advertisement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $adver)
    {
        $adver->delete();
        return redirect()->route('advertisement.index');
    }
}
