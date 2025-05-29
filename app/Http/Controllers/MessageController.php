<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Feline;
use App\Models\Cologne;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Models\Adopt_adver;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();

        if ($user->rol === 'Cologne') {
            // Si el usuario es una colonia, solo los mensajes dirigidos a su colonia
            $messages = Message::where('id_cologne', $user->cologne->id)->get();
            return view('messages.index', compact('messages'));

        } elseif ($user->rol === 'Adopter') {
            // Si el usuario es adoptante, solo sus propios mensajes
            $messages = Message::where('id_adopter', $user->adopter->id)->get();
            return view('messages.index', compact('messages'));

        } else {
            // Rol no reconocido o admin (opcional)
            abort(403, 'No autorizado');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       /*  $cologneId = $request->query('cologne_id');
        $cologne = Cologne::findOrFail($cologneId);
        return view('messages.create', compact('cologne')); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $message = new Message();
        $message->content = $request->input('body');
        $message->type = $request->input('type');
        $message->status = 'Pendiente';
        $message->id_adver = $request->input('adver_id');
        $message->id_cologne = $request->input('cologne_id');
        $message->id_adopter = $request->input('adopter_id');

        $message->save();

        $adopt_adver = new Adopt_adver();
        $adopt_adver->id_adopter = $request->input('adopter_id');
        $adopt_adver->id_adver = $request->input('adver_id');
        $adopt_adver->save();
        return redirect()->route('messages.index')->with('success', 'Mensaje creado correctamente.');

    }




    /**
     * Display the specified resource.
     */
    public function show(Message $message): View
    {
        if (Auth::user()->rol == 'cologne') {

        } else {
            return view('messages.show', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
    public function createForCologne(Feline $feline, Cologne $cologne)
    {
        if ($feline->id_cologne !== $cologne->id) {
            abort(403, 'El felino no pertenece a esta colonia');
        }
        return view('messages.create', compact('cologne', 'feline'));
    }
    public function updateStatus(Request $request, Message $message)
    {
        $newStatus = $request->input('status');

        if ($newStatus === 'Pendiente') {

            $message->status = 'En proceso';
            $message->save();

        } elseif ($newStatus === 'En proceso') {

            $message->status = 'En proceso';
            $message->save();

        } elseif ($newStatus === 'Resuelto') {

            $message->status = 'Resuelto';
            $message->save();

        } else {
            return redirect()->back()->with('error', 'Estado no válido.');
        }

        $message->save();

        return redirect()->back()->with('success', 'Estado del mensaje actualizado correctamente.');
    }
}
