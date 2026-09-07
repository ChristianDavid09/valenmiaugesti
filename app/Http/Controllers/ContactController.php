<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact.developer');
    }

    public function send(Request $request)
    {
        $request->validate([
            'type' => 'required|in:problemas_tecnicos,plan,error_registro,error_inicio_sesion,otros',
            'message' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Usuario que está enviando el formulario
        $user = Auth::user();

        // Imagen adjunta
        $image = null;

        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');

            if ($uploadedImage->isValid()) {
                $image = $uploadedImage;
            }
        }

        // Enviar correo
        Mail::to('valenmiaugesti@gmail.com')->send(
            new ContactMail(
                $user->name,
                $user->email,
                $request->type,
                $request->message,
                $image
            )
        );

        return redirect()
            ->route('contactUs')
            ->with(
                'success',
                'Tu mensaje ha sido enviado correctamente. ¡Gracias por contactar!'
            );
    }
}