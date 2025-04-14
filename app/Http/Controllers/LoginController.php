<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Colonia;
use App\Models\Adoptante;
use App\Http\Requests\signUpColonia;
use App\Http\Requests\signUpAdoptante;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function signUpForm(): view {
        return view('auth.signUp');
    }
    /**Aplicamos la lógica en este metodo para crear un nuevo usuario a su vez de una colonia, la colonia que la gestionara
     * un administrador, llevara el id de usuario.
     * Haremos la comprobación de permisos de la aplicación web en base al rol que se le asigna al usuario, a traves de $user->rol,
     * se comprobarán en las paginas que acciones puede realizar el usuario.
     */
    public function registerColonia(signUpColonia $request): RedirectResponse
    {
        //Creación de usuario
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->rol = User::ROL_COLONIA;
        $user->save();

        //Creación de colonia
        //El id_ref_com es el id de la comunidad que se le asigna a la colonia, para que el administrador pueda gestionar
        $colonia = new Colonia();
        $colonia->nombre = $request->input('colonia_name');
        $colonia->direccion = $request->input('colonia_location');
        $colonia->telefono_contacto = $request->input('phone');
        $colonia->provincia = $request->input('city');
        $colonia->id_ref_com = $request->input('id_ref_com');
        $colonia->descripcion = $request->input('description');
        $colonia->user_id = $user->id;
        $colonia->save();

        Auth::login($user);

        return redirect()->route('index');
    }

    /**Aqui crearemos al usuario junto al adoptante */
    public function registerAdoptante(signUpAdoptante $request): RedirectResponse
    {
        //Creación de usuario
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->rol = User::ROL_ADOPTANTE;
        $user->save();

        //Creación de adoptante
        //No olvides que el adoptante debe aportar el certificado de delitos penales por la seguridad del felino
        $adoptante = new Adoptante();
        $adoptante->nombre = $request->input('name');
        $adoptante->apellidos = $request->input('surname');
        $adoptante->dni = $request->input('dni');
        $adoptante->email = $request->input('email');
        $adoptante->fecha_nacimiento = $request->input('age');
        $adoptante->telefono = $request->input('phone');
        $adoptante->direccion = $request->input('address');
        $adoptante->provincia = $request->input('city');
        $adoptante->descripcion = $request->input('description');
        $adoptante->user_id = $user->id;

        //Gestión del certificado de delitos penales
        if ($request->hasFile('certificate') && $request->file('certificate')->isValid()) {

            $certificate = $request->file('certificate');

            // Generar un nombre único para el certificado, para diferenciarlo bien usaremos el nombre y el dni del adoptante
            $fileCertificate = $request->input('surname').'.'.$request->input('name').'.'.$request->input('dni').'.pdf';

            /* Ruta absoluta donde se debe guardar el PDF*/
            $routePDF = public_path('adoptantes/certificate');

            // Asegurarse de que la carpeta existe, y de lo contrario se crea la carpeta
            if (!file_exists($routePDF)) {
                mkdir($routePDF, 0777, true);
            }
            // Mover el archivo a la carpeta destino
            $certificate->move($routePDF, $fileCertificate);

            /* Mover la imagen a la carpeta destino...
            ¿Porque hacemos aqui dentro la gestión de la imagen?
                -Una vez se haya movido un archivo de la carpeta temporal, esta se elimina,
                si hubieramos movido la imagen antes del certificado, no encontraria el archivo temporal
                del certificado y nos daría un error. Junto con que el certificado es obligatorio, en caso
                de que no haya ningúna imagen, solo subira el pdf .*/
            //Gestión de la foto de perfil si ha decidido ponerla
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                $photo = $request->file('photo');

                // Generar un nombre único para la imagen, para diferenciarlo bien usaremos el nombre y el dni del adoptante
                $filePhoto = $request->input('surname').'.'.$request->input('name').'.'.$request->input('dni').'.png';

                /* Ruta absoluta donde se debe guardar la imagen, con la function public_path()
                obtenemos la ruta abosuluta del directorio al que queremos acceder*/
                $routeImage = public_path('adoptantes/images/profile');

                // Asegurarse de que la carpeta existe, y de lo contrario se crea la carpeta
                if (!file_exists($routeImage)) {
                    mkdir($routeImage, 0777, true);
                }
                $photo->move($routeImage, $filePhoto);
                // Guardar el nombre del archivo en la base de datos
                $adoptante->foto = $filePhoto;
            }

            // Guardar el nombre del archivo en la base de datos
            $adoptante->certificado = $fileCertificate;

        }
        // Guardar el adoptante en la base de datos
        $adoptante->save();

        Auth::login($user);

        return redirect()->route('index');

    }

}
