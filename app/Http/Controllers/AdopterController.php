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
     * La edición y creacion del adoptante se realiza en "LoginController"
     */
   
    public function show(Adopter $adopter)
    {
        // Aquí puedes retornar una vista con los detalles del adoptante
        return view('adopters.show', compact('adopter'));
    }

    public function destroy(Adopter $adopter)
    {
        /**Comprobamos que el usuario es un adoptante, aparte de que sea el dueño de la cuenta,
         * y confirmamos que tenga foto, una vez comprobamos, eliminamos todas las fotos relacionadas
         * con este usuario, y el certificado del adoptante
         */
        if (Auth::check() && Auth::user()->rol == 'Adopter' && Auth::user()->adopter->id == $adopter->id) {

            /*Utilizamos la funcion public_path para obtener la ruta absoluta del directorio
            Si el archivo existe, lo eliminamos con la función unlink()*/

            if ($adopter->photo) {
                Storage::disk('s3')->delete(
                    'adopters/profile/' . $adopter->photo
                );
            }
            if(file_exists(public_path('certificates/' . $adopter->certificate))) {
                unlink(public_path('certificates/' . $adopter->certificate));

            }
            // Recorremos las publicaciones del adoptante y eliminamos las fotos asociadas
            foreach ($adopter->user->publications as $publication) {
                if (file_exists(public_path('pubs/photo/' . $publication->photo))) {
                    unlink(public_path('pubs/photo/' . $publication->photo));
                }
            }

            // Una vez vaciado los directorios de fotos, eliminamos al usuario completo, que incluye al adoptante
            $adopter->user->delete();
            Auth::logout(); // Cerrar sesión del usuario que eliminó la colonia
            return redirect()->route('index')->with('success', 'Colonia eliminada con éxito.');
        } else {
            return redirect()->route('account')->with('error', 'No se ha podido eliminar la cuenta.');
        }

    }
}
