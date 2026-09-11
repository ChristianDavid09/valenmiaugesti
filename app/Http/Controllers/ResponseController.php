<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewChatMessage;
use App\Models\Cologne;
use App\Models\Adopter;

use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Las respuestas no tienen el metodo destroy, ya que por el momento no
     * se prevee que se eliminen las respuestas por fines legales
     */

    public function index()
    {
        $messages = Message::with(['adopter', 'responses.user'])->get();
        return view('responses.index', compact('messages'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'content' => 'required|string|max:255',
        ]);

        $response = new Response();
        $response->message_id = $request->message_id;
        $response->user_id = Auth::user()->id;
        $response->content = $request->content;
        $response->save();

        /*
         * Buscamos el mensaje original para saber
         * quién debe recibir la notificación.
         */
        $message = Message::findOrFail($request->message_id);

        $sender = Auth::user();
        $recipient = null;

        if ($sender->rol === User::ROL_ADOPTER) {

            // El adoptante responde a la colonia.
            $cologne = Cologne::find($message->id_cologne);

            if ($cologne && $cologne->user_id) {
                $recipient = User::find($cologne->user_id);
            }

        } elseif ($sender->rol === User::ROL_COLOGNE) {

            // La colonia responde al adoptante.
            $adopter = Adopter::find($message->id_adopter);

            if ($adopter && $adopter->user_id) {
                $recipient = User::find($adopter->user_id);
            }
        }

        if (
            $recipient &&
            $recipient->id !== $sender->id &&
            !$recipient->isOnline()
        ) {
            $recipient->notify(
                new NewChatMessage($sender->name)
            );
        }

        return redirect()
            ->route('responses.forMessage', $response->message_id)
            ->with('success', 'Respuesta enviada correctamente.');
    }
    public function showForMessage(Message $message)
    {
        // Cargar las respuestas
        $message->load('responses.user');

        return view('responses.index', compact('message'));
    }


}
