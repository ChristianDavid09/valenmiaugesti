<?php

namespace App\Http\Controllers;

use App\Models\Adopter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Cologne;

class AdopterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Adopter $adopter)
    {
        // Aquí puedes retornar una vista con los detalles del adoptante
        return view('adopters.show', compact('adopter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adopter $adopter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adopter $adopter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adopter $adopter)
    {
        if (Auth::check() && Auth::user()->rol == 'Adopter' && Auth::user()->adopter->id == $adopter->id) {

            if ($adopter->photo) {
                if (file_exists(public_path('images/adopters/profile/' . $adopter->photo))) {
                    unlink(public_path('images/adopters/profile/' . $adopter->photo));
                }
            }
            if(file_exists(public_path('certificates/' . $adopter->certificate))) {
                unlink(public_path('certificates/' . $adopter->certificate));

            }

            foreach ($adopter->user->publications as $publication) {
                if (file_exists(public_path('pubs/photo/' . $publication->photo))) {
                    unlink(public_path('pubs/photo/' . $publication->photo));
                }
            }


            $adopter->user->delete();
            Auth::logout(); // Cerrar sesión del usuario que eliminó la colonia
            return redirect()->route('index')->with('success', 'Colonia eliminada con éxito.');
        } else {
            return redirect()->route('account')->with('error', 'No se ha podido eliminar la cuenta.');
        }

    }
}
