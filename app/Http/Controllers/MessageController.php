<?php
/**
 * @author: David Murillo
 * @version: 1.0
 * @since: 05-03-2025
 */
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
     * Por el momento no se implementa el metodo destroy, ya que no se prevee que se eliminen mensajes
     * por fines legales. Los mensajes se mantienen para registro y seguimiento.
     * En el futuro, si se implementa la eliminación, se debe considerar la privacidad y el cumplimiento legal.
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
            // Rol no reconocido
            abort(403, 'No autorizado');
        }
    }

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

    public function show(Message $message): View
    {
        if (Auth::user()->rol == 'cologne') {

        } else {
            return view('messages.show', compact('message'));
        }
    }

    public function createForCologne(Feline $feline, Cologne $cologne)
    {
        /**
         * Crea un mensaje para una colonia específica.
         * Verificamos que el felino pertenece a la colonia y mostramos la vista de creación de mensajes
         */
        if ($feline->id_cologne !== $cologne->id) {
            abort(403, 'El felino no pertenece a esta colonia');
        }
        return view('messages.create', compact('cologne', 'feline'));
    }
    public function updateStatus(Request $request, Message $message)
    {
        /**
         * Actualiza el estado de un mensaje.
         * @param Request $request
         * @param Message $message
         * @return RedirectResponse
         * Comprobamos en que estado se enceuntra el mensaje y lo actualizamos        
         */
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
