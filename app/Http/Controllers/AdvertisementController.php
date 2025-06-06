<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Feline;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AdverFeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AdvertisementController extends Controller
{
    
    public function index()
    {
        // Cogemos todos los anuncios de la base de datos
        if (Auth::user()->rol == User::ROL_ADOPTER) {
            $advertisements = Advertisement::with('feline')->get();
            return view('advertisement.index', compact('advertisements'));
        }
        // Si el usuario es un colono, cogemos solo los anuncios de su colonia
        $cologneId = Auth::user()->cologne->id;

        // Cogemos solo los anuncios cuyo felino pertenece a esa colonia
        /**
         * La función whereHas() permite filtrar los anuncios de una consulta Eloquent (consulta para 
         * interactuar con la base de datos usando PHP) basandose en la existencia de una relacion que cumpla ciertas condiciones.
         *
         * Este filtro sería equivalente a esta consulta SQL:
         *
         * SELECT anuncios.*, felinos.*
         * FROM anuncios
         * JOIN felinos ON anuncios.felino_id = felinos.id
         * WHERE felinos.id_colonia = (id de la colonia del usuario)
         */

        $advertisements = Advertisement::whereHas('feline', function($query) use ($cologneId) {
            $query->where('id_cologne', $cologneId);
        })->with('feline')->get();

        return view('advertisement.index', compact('advertisements'));
    }

    public function create($feline)
    {
        $feline = Feline::find($feline);
        return view('advertisement.create', compact('feline'));
    }

    public function store(AdverFeline $request)
    {
        $advertisement = new Advertisement();
        $advertisement->title = $request->input('title');
        $advertisement->type = $request->input('type');
        $advertisement->description = $request->input('description');
        $advertisement->id_feline = $request->input('feline_id');

        $advertisement->save();

        // Actualiamos el campo booleano in_active del felino asociado al anuncio
        $advertisement->feline->in_active = 1;
        $advertisement->feline->save();
        return redirect()->route('advertisement.index');

    }

    public function show(Advertisement $adver): View
    {
        return view('advertisement.show', compact('adver'));
    }

    public function edit(Advertisement $adver)
    {
        // Verificar si el usuario autenticado es el propietario del anuncio
        if (Auth::user()->rol == User::ROL_ADOPTER) {
            abort(403, 'No tienes permiso para editar este anuncio.');
        }
        if ($adver->feline->id_cologne !== Auth::user()->cologne->id) {
            abort(403, 'No tienes permiso para editar este anuncio.');
        }

        return view('advertisement.edit', compact('adver'));
    }

    public function update(Request $request, Advertisement $adver)
    {
        $adver->title = $request->input('title');
        $adver->type = $request->input('type');
        $adver->description = $request->input('description');
        $adver->id_feline = $request->input('feline_id');

        $adver->save();

        return redirect()->route('advertisement.index');
    }

    public function destroy(Advertisement $adver)
    {
        $adver->delete();
        // Actualizamos el campo booleano in_active del felino asociado al anuncio a 0
        // Esto indica que el felino ya no está activo en la adopción y solo estara como un registro de la colonia
        $adver->feline->in_active = 0;
        $adver->feline->save();
        return redirect()->route('felines.index');
    }
}
