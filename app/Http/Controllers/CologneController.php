<?php
/**
 * @author: David Murillo
 * @version: 1.0
 * @since: 05-03-2025
 */
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
     * La edicion de colonias solo se realiza en LoginController
     */
    public function index(): view
    {
        //Utilizamos la paginacion para mostrar 6 colonias por página
        $colognes = Cologne::latest()->paginate(6);
        return view('colognes.index', compact('colognes'));
    }
    public function show(Cologne $cologne): view
    {
        // Comprobamos si el usuario está autenticado y es una colonia
        // Si es así, comprobamos si la colonia que se está mostrando es la misma que la del usuario autenticado
        // Si es así, pasamos una variable "isOwner" a la vista para mostrar opciones adicionales
        if(Auth::check() && Auth::user()->rol == 'Cologne') {
            $isOwner = Auth::check() && $cologne->id == Auth::user()->cologne->id;
            return view('colognes.show', compact('cologne', 'isOwner'));
        } else {
            return view('colognes.show', compact('cologne'));
        }


    }

    public function edit(Cologne $cologne)
    {
        // Comprobamos si el usuario autenticado es una Colonia y si es el dueño de la colonia que se está editando
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

    public function destroy(Cologne $cologne)
{
    /**
     * Comprobamos que el usuario es una colonia
     * y que es el propietario de la cuenta.
     *
     * Si todo es correcto:
     * - Eliminamos la foto de la colonia.
     * - Eliminamos las fotos de todos sus felinos.
     * - Eliminamos las fotos de todas sus publicaciones.
     * - Eliminamos al usuario.
     * - Cerramos su sesión.
     */

    if (
        Auth::check() &&
        Auth::user()->rol == 'Cologne' &&
        Auth::user()->cologne->id == $cologne->id
    ) {

        // Eliminar foto de la colonia
        if ($cologne->photo) {
            Storage::disk('s3')->delete(
                'colognes/profile/' . $cologne->photo
            );
        }

        // Eliminar fotos de los felinos de la colonia
        foreach ($cologne->felines as $feline) {

            if ($feline->photo) {
                Storage::disk('s3')->delete(
                    'colognes/felines/' . $feline->photo
                );
            }
        }

        // Eliminar fotos de las publicaciones de la colonia
        foreach ($cologne->user->publications as $publication) {

            if ($publication->photo) {
                Storage::disk('s3')->delete(
                    'pubs/photo/' . $publication->photo
                );
            }
        }

        // Eliminar usuario
        $cologne->user->delete();

        // Cerrar sesión
        Auth::logout();

        return redirect()
            ->route('index')
            ->with('success', 'Colonia eliminada con éxito.');

    } else {

        return redirect()
            ->route('account')
            ->with('error', 'No se ha podido eliminar la colonia.');
    }
}

}
