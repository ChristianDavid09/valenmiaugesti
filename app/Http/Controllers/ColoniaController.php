<?php

namespace App\Http\Controllers;

use App\Models\Colonia;
use Illuminate\Http\Request;

class ColoniaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(colonia $colonia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(colonia $colonia)
    {
        return view('colognes.edit', compact('colonia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, colonia $colonia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(colonia $colonia)
    {
        //
    }
}
