<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $publications = Publication::all();
        return view('publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $filePhoto = $request->input('title').'.png';

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('posts', 'public');
        }

        $publication = new Publication();
        $publication->title = $request->title;
        $publication->content = $request->content;
        
        $publication->id_user= Auth::id(); 

        //Gestión de la foto de la publicación
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $photo = $request->file('photo');


            /* Ruta absoluta donde se debe guardar la imagen*/
            $routePhoto = public_path('publication/photo');

            // Asegurarse de que la carpeta existe, y de lo contrario se crea la carpeta
            if (!file_exists($routePhoto)) {
                mkdir($routePhoto, 0777, true);
            }
            // Mover el archivo a la carpeta destino
            $photo->move($routePhoto, $filePhoto);
        
            $publication->photo = $filePhoto;

        } 

        $publication->save();
        return redirect()->route('publications.index')->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
