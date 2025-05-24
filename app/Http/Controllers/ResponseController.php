<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Message;

use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with(['adopter', 'responses.user'])->get();
        return view('responses.index', compact('messages'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('responses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
