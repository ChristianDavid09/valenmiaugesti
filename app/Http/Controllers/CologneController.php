<?php

namespace App\Http\Controllers;

use App\Models\Cologne;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CologneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $colognes = Cologne::all();
        return view('colognes.index', compact('colognes'));
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
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(Cologne $cologne): view
    {

        if(Auth::check() && Auth::user()->rol == 'Cologne') {
            $isOwner = Auth::check() && $cologne->id == Auth::user()->cologne->id;
            return view('colognes.show', compact('cologne', 'isOwner'));
        } else {
            return view('colognes.show', compact('cologne'));
        }


    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cologne $cologne)
    {
        return view('colognes.edit', compact('cologne'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cologne $cologne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cologne $cologne)
    {
        //
    }

}
