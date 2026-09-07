<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class PublicationController extends Controller
{
    public function index(): View
    {
        // Obtenemos las publicaciones más recientes y las paginamos
        // Utilizamos el método latest() para ordenar por fecha de creación descendente
        // y paginate(6) para mostrar 6 publicaciones por página.


        /* publications = Publication::latest()->paginate(6);
        return view('publications.index', compact('publications')); */
        return view('publications.process');

    }

    public function create(): View
    {
        /* return view('publications.create'); */
        return view('publications.process');
    }

    public function store(Request $request): RedirectResponse
    {

        $name = Auth::user()->name;


        $publication = new Publication();
        $publication->content = $request->content;

        $publication->id_user= Auth::id();

        //Gestión de la foto de la publicación
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            //Creamos un nombre unico para la foto
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

        /* $publication->save();
        return redirect()->route('publications.index')->with('success', 'Publication created successfully.'); */
        return view('publications.process');
    }

    public function edit(Publication $publication)
    {
        // Verificar si el usuario autenticado es el propietario de la publicación
        if ($publication->id_user !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta publicación.');
        }

        /* return view('publications.edit', compact('publication')); */
        return view('publications.process');
    }

    public function update(Request $request, Publication $publication)
    {
        $publication->content = $request->input('content');
        $publication->id_user = Auth::id();
        //Gestión de la foto de la publicación
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Verificamos si la publicacion tiene foto
            $photo = $request->file('photo');

            $filePhoto = $publication->photo;
            $routePhoto = public_path('pubs/photo');

            // Mover el archivo a la carpeta destino
            $photo->move($routePhoto, $filePhoto);

            $publication->photo = $filePhoto;
        }
        $publication->save();
        /* return redirect()->route('publications.index')->with('success', 'Publicacion actualizada correctamente.'); */
        return view('publications.process');
    }

    public function destroy(Publication $publication)
    {
        // Verificamos si la publicacion tiene foto
        if ($publication->photo) {
            $routeImage = public_path('pubs/photo/' . $publication->photo);
            if (file_exists($routeImage)) {
                unlink($routeImage);
            }
        }

        $publication->delete();
        /* return redirect()->route('publications.myPub')->with('success', 'Publicacion eliminada correctamente.'); */
        return view('publications.process');
    }
    /**
     * Metodo creado para mostrar las publicaciones del usuario autenticado.
     * Verificamos que el usuario autenticado es el propietario de las publicaciones
     * y mostramos la vista de las publicaciones del usuario.
     */
    public function myPub()
    {
        $publications = Publication::where('id_user', Auth::id())->get();
        /* return view('publications.myPub', compact('publications')); */
        return redirect()->route('publications.process');
    }
}
