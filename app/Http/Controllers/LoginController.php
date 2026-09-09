<?php
/**
 * @author: David Murillo
 * @version: 1.0
 * @since: 05-03-2025
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cologne;
use App\Models\Adopter;
use App\Http\Requests\signUpCologne;
use App\Http\Requests\signUpAdopter;
use App\Http\Requests\editUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function signUpForm(): View
    {
        return view('auth.signUp');
    }

    public function registerColonia(signUpCologne $request): RedirectResponse
    {
        $filePhoto = $request->input('colonia_name') . '.png';

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        /* $user->dni = $request->get('dni'); */
        $user->password = Hash::make($request->get('password'));
        $user->photo_url = $filePhoto;
        $user->rol = User::ROL_COLOGNE;
        $user->save();

        $cologne = new Cologne();
        $cologne->name = $request->input('colonia_name');
        $cologne->adress = $request->input('colonia_location');
        $cologne->phone = $request->input('phone');
        $cologne->province = $request->input('city');
        /* $cologne->id_ref_com = $request->input('id_ref_com'); */
        $cologne->description = $request->input('description');
        $cologne->user_id = $user->id;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');

            $filePhoto = 'cologne_' . uniqid() . '.png';

            Storage::disk('s3')->put(
                'colognes/profile/' . $filePhoto,
                file_get_contents($photo->getPathname())
            );

            $cologne->photo = $filePhoto;
            $user->photo_url = $filePhoto;
            $user->save();
        }

        $cologne->save();

        Auth::login($user);

        return redirect()->route('account');
    }

    public function registerAdoptante(signUpAdopter $request): RedirectResponse
    {
        $filePhoto = $request->input('name') . '.png';
        /* $fileCertificate = $request->input('dni').'.pdf'; */

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        /* $user->dni = $request->get('dni'); */
        $user->password = Hash::make($request->get('password'));
        $user->photo_url = $filePhoto;
        $user->rol = User::ROL_ADOPTER;
        $user->save();

        $adopter = new Adopter();
        $adopter->name = $request->input('name');
        $adopter->date_birth = $request->input('age');
        $adopter->phone = $request->input('phone');
        $adopter->address = $request->input('address');
        $adopter->province = $request->input('city');
        $adopter->description = $request->input('description');
        $adopter->user_id = $user->id;

        /* Certificate block
        $adopter->certificate = $fileCertificate;
        */

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');

            Storage::disk('s3')->put(
                'adopters/profile/' . $filePhoto,
                file_get_contents($photo->getPathname())
            );

            $adopter->photo = $filePhoto;
        }

        $adopter->save();

        Auth::login($user);

        return redirect()->route('account');
    }

    public function loginForm(): View|RedirectResponse
    {
        if (Auth::viaRemember()) {
            return redirect()->route('account');
        } elseif (Auth::check()) {
            return redirect()->route('account');
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $rememberLogin = ($request->get('remember')) ? true : false;

        if (Auth::guard('web')->attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();

            return redirect()->route('account');
        }

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'El correo electrónico o la contraseña no son correctos.',
            ])
            ->withInput($request->only('email'));
    }

    public function edit(User $user): View
    {
        if ($user->id !== Auth::user()->id) {
            abort(403, 'No tienes permiso para modificar este usuario.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(editUser $request, User $user): RedirectResponse
    {
        if ($user->id !== Auth::user()->id) {
            abort(403, 'No tienes permiso para modificar este usuario.');
        }

        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        /* $user->dni = $request->input('dni'); */

        if ($user->rol == User::ROL_COLOGNE) {

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                $photo = $request->file('photo');

                $oldFilename = $user->cologne->photo;

                $filename = $user->cologne->name . '.' . $photo->getClientOriginalExtension();

                Storage::disk('s3')->put(
                    'colognes/profile/' . $filename,
                    file_get_contents($photo->getPathname())
                );

                if (
                    $oldFilename &&
                    $oldFilename !== $filename
                ) {
                    Storage::disk('s3')->delete(
                        'colognes/profile/' . $oldFilename
                    );
                }

                $data['photo'] = $filename;

                $user->photo_url = $filename;
                $user->cologne->photo = $filename;

            } else {
                $data['photo'] = $user->cologne->photo;
            }

            $user->cologne->province = $request->input('province');
            $user->cologne->adress = $request->input('address');
            $user->cologne->phone = $request->input('phone');

            $user->cologne->save();

        } else {

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                $photo = $request->file('photo');

                $oldFilename = $user->adopter->photo;

                $filename = $user->name . '.' . $photo->getClientOriginalExtension();

                Storage::disk('s3')->put(
                    'adopters/profile/' . $filename,
                    file_get_contents($photo->getPathname())
                );

                if (
                    $oldFilename &&
                    $oldFilename !== $filename
                ) {
                    Storage::disk('s3')->delete(
                        'adopters/profile/' . $oldFilename
                    );
                }

                $data['photo'] = $filename;

                $user->photo_url = $filename;
                $user->adopter->photo = $filename;

            } else {
                $data['photo'] = $user->adopter->photo;
            }

            $user->adopter->date_birth = $request->input('date_birth');
            $user->adopter->name = $request->input('name');
            $user->adopter->province = $request->input('province');
            $user->adopter->address = $request->input('address');
            $user->adopter->phone = $request->input('phone');
            $user->adopter->description = $request->input('description');

            $user->adopter->save();
        }

        $user->update($data);

        return redirect()
            ->route('account')
            ->with('success', 'Cuenta actualizada correctamente');
    }

    public function updateColony(
        Cologne $cologne,
        Request $request
    ): RedirectResponse {

        $cologne->name = $request->input('name');
        $cologne->description = $request->input('description');

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $photo = $request->file('photo');

            $oldFilename = $cologne->photo;

            $filename = $cologne->name . '.' . $photo->getClientOriginalExtension();

            Storage::disk('s3')->put(
                'colognes/profile/' . $filename,
                file_get_contents($photo->getPathname())
            );

            if (
                $oldFilename &&
                $oldFilename !== $filename
            ) {
                Storage::disk('s3')->delete(
                    'colognes/profile/' . $oldFilename
                );
            }

            $cologne->photo = $filename;
        }

        $cologne->update();

        return redirect()
            ->route('account')
            ->with('success', 'Colonia actualizada correctamente');
    }

    public function account(): View
    {
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