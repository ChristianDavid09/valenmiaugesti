<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\colonia;
use App\Http\Requests\signUpCologne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function signUpForm() {
        return view('auth.signUp');
    }
    public function registerCologne(signUpCologne $request): RedirectResponse
    {

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->rol = 'colonia';
        $user->save();

        $colonia = new colonia();
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
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')->with('success', 'Logout successful!');
    }

}
