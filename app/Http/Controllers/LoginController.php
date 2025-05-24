<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cologne;
use App\Models\Adopter;
use App\Http\Requests\signUpCologne;
use App\Http\Requests\signUpAdopter;
use App\Http\Requests\editUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
    public function registerColonia(signUpCologne $request): RedirectResponse
    {
        // Generar un nombre único para la imagen, para diferenciarlo bien usaremos el nombre y el dni del adoptante
        $filePhoto = $request->input('id_ref_com').'.'.$request->input('colonia_name').'.png';

        //Creación de usuario
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->dni = $request->get('dni');
        $user->password = Hash::make($request->get('password'));
        $user->photo_url = $filePhoto;
        $user->rol = User::ROL_COLOGNE;
        $user->save();

        //Creación de colonia
        //El id_ref_com es el id de la comunidad que se le asigna a la colonia, para que el administrador pueda gestionar
        $cologne = new Cologne();
        $cologne->name = $request->input('colonia_name');
        $cologne->adress = $request->input('colonia_location');
        $cologne->phone = $request->input('phone');
        $cologne->province = $request->input('city');
        $cologne->id_ref_com = $request->input('id_ref_com');
        $cologne->description = $request->input('description');
        $cologne->user_id = $user->id;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $photo = $request->file('photo');

            /* Ruta absoluta donde se debe guardar la imagen, con la function public_path()
            obtenemos la ruta abosuluta del directorio al que queremos acceder*/
            $routeImage = public_path('images/colognes/profile');

            // Asegurarse de que la carpeta existe, y de lo contrario se crea la carpeta
            if (!file_exists($routeImage)) {
                mkdir($routeImage, 0777, true);
            }
            $photo->move($routeImage, $filePhoto);
            // Guardar el nombre del archivo en la base de datos
            $cologne->photo = $filePhoto;
        }

        $cologne->save();

        Auth::login($user);

        return redirect()->route('account');
    }

    /**Aqui crearemos al usuario junto al adoptante */
    public function registerAdoptante(signUpAdopter $request): RedirectResponse
    {
        // Generar un nombre único para la imagen, para diferenciarlo bien usaremos el nombre y el dni del adoptante
        $filePhoto = $request->input('surname').'.'.$request->input('name').'.png';
        $fileCertificate = $request->input('surname').'.'.$request->input('name').'.pdf';


        //Creación de usuario
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->dni = $request->get('dni');
        $user->password = Hash::make($request->get('password'));
        $user->photo_url = $filePhoto;
        $user->rol = User::ROL_ADOPTER;
        $user->save();

        //Creación de adoptante
        //No olvides que el adoptante debe aportar el certificado de delitos penales por la seguridad del felino
        $adopter = new Adopter();
        $adopter->name = $request->input('name');
        $adopter->surname = $request->input('surname');
        $adopter->date_birth = $request->input('age');
        $adopter->phone = $request->input('phone');
        $adopter->address = $request->input('address');
        $adopter->province = $request->input('city');
        $adopter->description = $request->input('description');
        $adopter->user_id = $user->id;

        //Gestión del certificado de delitos penales
        if ($request->hasFile('certificate') && $request->file('certificate')->isValid()) {

            $certificate = $request->file('certificate');


            /* Ruta absoluta donde se debe guardar el PDF*/
            $routePDF = public_path('adopters/certificate');

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

                /* Ruta absoluta donde se debe guardar la imagen, con la function public_path()
                obtenemos la ruta abosuluta del directorio al que queremos acceder*/
                $routeImage = public_path('images/adopters/profile');

                // Asegurarse de que la carpeta existe, y de lo contrario se crea la carpeta
                if (!file_exists($routeImage)) {
                    mkdir($routeImage, 0777, true);
                }
                $photo->move($routeImage, $filePhoto);
                // Guardar el nombre del archivo en la base de datos
                $adopter->photo = $filePhoto;
            }

            // Guardar el nombre del archivo en la base de datos
            $adopter->certificate = $fileCertificate;

        }
        // Guardar el adoptante en la base de datos
        $adopter->save();

        Auth::login($user);

        return redirect()->route('account');

    }
    public function loginForm(): view {
    /**
     * Haremos un par de comprobaciones antes de redirigirlo al formulario para iniciar la sesión;
     * -Si el usuario uso el checkbox para recordar la sesión
     * -Si el usuario ya esta logeado
     * En caso de que estos dos no se cumplan, le redirigimos al formulario de login
     *  */
        if (Auth::viaRemember()) {
            return redirect()->route('account');
        } else if (Auth::check()) {
            return redirect()->route('account');
        } else {
            return view('auth.login');
        }


        return view('auth.login');
    }
    public function login(Request $request): RedirectResponse
    {
    /**
     * Recogemos las credenciales del formulario de login, en caso de que todo haya ido bien redirigirá directamente a la cuenta del usuario,
     * en caso de que no, le redirigirá de nuevo al formulario de inicio de sesión.
     * Tambien se gestionara el checkbox de recordar la sesión en caso de que quiera entrar en la cuenta sin tener que volver a poner las credenciales.
     */
        $credentials = $request->only('email', 'password');
        $rememberLogin = ($request->get('remember')) ? true : false;

        if (Auth::guard('web')->attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();
            return redirect()->route('account');
        } else {
            $error = 'Error al Iniciar sesión';
            return redirect()->route('login');
        }
    }
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(editUser $request, User $user): RedirectResponse
    {

        $data = $request->only(['name', 'email', 'dni']);


        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        Validator::make($data, [
            'dni' => [
                'required',
                'string',
                'max:9',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($data);


        return redirect()->route('account');
    }



    public function account(): view {
        return view('users.account');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

}
