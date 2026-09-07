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
    // Si el usuario es adoptante, ve todos los anuncios
    if (Auth::user()->rol == User::ROL_ADOPTER) {

        $advertisements = Advertisement::with('feline')->get();

        return view('advertisement.index', compact('advertisements'));
    }

    // Cogemos la colonia del usuario autenticado
    $cologne = Auth::user()->cologne;

    // Cogemos el ID de la colonia
    $cologneId = $cologne->id;

    // Consulta base
    $query = Advertisement::whereHas('feline', function ($query) use ($cologneId) {
        $query->where('id_cologne', $cologneId);
    })->with('feline');

    // 👇 AQUÍ comprobamos el tipo de usuario
    if ($cologne->t_user === 'basic') {

        // Solo mostramos 3 publicaciones
        $advertisements = $query
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

    } else {

        // Premium ve todas las publicaciones
        $advertisements = $query->get();
    }

    return view('advertisement.index', compact('advertisements'));
}

    public function create($feline)
    {
        $feline = Feline::findOrFail($feline);

        $colony = $feline->cologne;

        if ($colony->t_user === 'basic') {

            $total = Advertisement::whereHas('feline', function ($query) use ($colony) {
                $query->where('id_cologne', $colony->id);
            })->count();

            if ($total >= 3) {
                return redirect()->back()->with(
                    'error',
                    'Las colonias con nivel básico solo pueden tener 3 publicaciones. Si necesitas más, clica <a href="'. route('contactUs') .'">aquí</a> para contactar con el desarrollador.'
                );
            }
        }

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
