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
        $publications = Publication::latest()->paginate(6);
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

        $name = Auth::user()->name;


        $publication = new Publication();
        $publication->content = $request->content;

        $publication->id_user= Auth::id();

        //Gestión de la foto de la publicación
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {


            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $timeForFile = now()->timestamp;
            $filePhoto = explode(' ', $name)[0].'_'.$timeForFile.'.'.$extension;
            $routePhoto = public_path('pubs/photo');

            /* Ruta absoluta donde se debe guardar la imagen*/
            $routePhoto = public_path('pubs/photo');

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
        // Verificar si el usuario autenticado es el propietario de la publicación
        if ($publication->id_user !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta publicación.');
        }

        return view('publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        $publication->content = $request->input('content');
        $publication->id_user = Auth::id();
        //Gestión de la foto de la publicación
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {


            $photo = $request->file('photo');

            $filePhoto = $publication->photo;
            $routePhoto = public_path('pubs/photo');

            // Mover el archivo a la carpeta destino
            $photo->move($routePhoto, $filePhoto);

            $publication->photo = $filePhoto;
        }
        $publication->save();
        return redirect()->route('publications.index')->with('success', 'Publicacion actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        if ($publication->photo) {
            $routeImage = public_path('pubs/photo/' . $publication->photo);
            if (file_exists($routeImage)) {
                unlink($routeImage);
            }
        }

        $publication->delete();
        return redirect()->route('publications.myPub')->with('success', 'Publicacion eliminada correctamente.');
    }
    public function myPub()
    {
        $publications = Publication::where('id_user', Auth::id())->get();
        return view('publications.myPub', compact('publications'));
    }
}
