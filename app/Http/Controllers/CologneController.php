<?php

namespace App\Http\Controllers;

use App\Models\Cologne;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class CologneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $colognes = Cologne::all();
        return view('colognes.index', compact('colognes'));
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

    public function show(Cologne $cologne): view
    {

        if(Auth::check() && Auth::user()->rol == 'Cologne') {
            $isOwner = Auth::check() && $cologne->id == Auth::user()->cologne->id;
            return view('colognes.show', compact('cologne', 'isOwner'));
        } else {
            return view('colognes.show', compact('cologne'));
        }


    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cologne $cologne)
    {
        if (Auth::user()->rol == "Cologne") {

            if ($cologne->user->id !== Auth::user()->id) {
                abort(403, 'No tienes permiso para modificar este usuario.');
            }
        } else {

            if ($cologne->user->id !== Auth::user()->id) {
                abort(403, 'No tienes permiso para modificar este usuario.');
            }
        }
        return view('colognes.edit', compact('cologne'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cologne $cologne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cologne $cologne)
    {


        if (Auth::check() && Auth::user()->rol == 'Cologne' && Auth::user()->cologne->id == $cologne->id) {

            if ($cologne->photo) {
                if (file_exists(public_path('images/colognes/profile/' . $cologne->photo))) {
                    unlink(public_path('images/colognes/profile/' . $cologne->photo));
                }
            }
            foreach ($cologne->felines as $feline) {
                if (file_exists(public_path('images/colognes/felines/' . $feline->photo))) {
                    unlink(public_path('images/colognes/felines/' . $feline->photo));
                }
            }
            foreach ($cologne->user->publications as $publication) {
                if (file_exists(public_path('pubs/photo/' . $publication->photo))) {
                    unlink(public_path('pubs/photo/' . $publication->photo));
                }
            }


            $cologne->user->delete();
            Auth::logout(); // Cerrar sesión del usuario que eliminó la colonia
            return redirect()->route('index')->with('success', 'Colonia eliminada con éxito.');
        } else {
            return redirect()->route('account')->with('error', 'No se ha podido eliminar la colonia.');
        }
    }

}
