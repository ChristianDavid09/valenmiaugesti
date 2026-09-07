<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Message;

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
        /**
         * Validamos los datos de la solicitud
         * Aseguramos que el mensaje exista y que el contenido no esté vacío.
         */
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'content' => 'required|string|max:255',
        ]);

        $response = new Response();
        $response->message_id = $request->message_id;
        $response->user_id = Auth::user()->id;
        $response->content = $request->content;
        $response->save();

        return redirect()->route('responses.forMessage', $response->message_id)
                ->with('success', 'Respuesta enviada correctamente.');

    }
    public function showForMessage(Message $message)
    {
        // Cargar las respuestas
        $message->load('responses.user');

        return view('responses.index', compact('message'));
    }


}
