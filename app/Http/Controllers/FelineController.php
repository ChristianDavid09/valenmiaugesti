<?php

namespace App\Http\Controllers;

use App\Models\Feline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Colognes;
use App\Models\Advertisement;


class FelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colognes = Auth::user()->cologne;
        $felines = $colognes->felines;
        return view('feline.index', compact('felines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {



        $photo = $request->file('image');
        $timeForFile = now()->timestamp;
        $extension = $photo->getClientOriginalExtension();
        $filePhoto =  $request->input('name') . '.' .$request->input('race').'.'. $timeForFile. '.' . $extension;

        $feline = new Feline();
        $feline->name = $request->input('name');
        $feline->race = $request->input('race');
        $feline->sex = $request->input('sex');
        $feline->sterilized = $request->input('sterilized');
        $feline->health_status = $request->input('health_status');
        $feline->id_cologne = Auth::user()->cologne->id;

        //Hacemos comprobacionees, si el campo es nulo, vacío o no es un entero, lo dejamos como nulo

        if($request->input('age') === null || $request->input('age') === '' || !is_numeric($request->input('age'))) {
            $feline->age = null;
        } else {
            $feline->age = $request->input('age');
        }


        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $routeImage = public_path('images/colognes/felines');

            if (!file_exists($routeImage)) {
                mkdir($routeImage, 0777, true);
            }

            $photo->move($routeImage, $filePhoto);
            $feline->photo = $filePhoto;

        }
        $feline->save();
        return redirect()->route('felines.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feline $feline)
    {
        $isOwner = Auth::check() && Auth::user()->rol === 'Cologne' && $feline->id_cologne === Auth::user()->cologne->id;
        return view('feline.show', compact('feline', 'isOwner'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feline $feline)
    {
        return view ('feline.edit', ['feline' => $feline]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feline $feline)
    {



        $feline->name = $request->input('name');
        $feline->age = $request->input('age');
        $feline->race = $request->input('race');
        $feline->sex = $request->input('sex');
        $feline->health_status = $request->input('health_status');
        $feline->sterilized = $request->input('sterilized');
        $feline->id_cologne = Auth::user()->cologne->id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $photo = $request->file('image');

            $filePhoto = $feline->photo;

            $routeImage = public_path('images/colognes/felines');


            $photo->move($routeImage, $filePhoto);

        }

        $feline->save();
        return redirect()->route('felines.index')->with('success', 'Michi actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feline $feline)
    {

        // Eliminar la foto del michi
        if ($feline->photo) {
            $routeImage = public_path('images/colognes/felines/' . $feline->photo);
            if (file_exists($routeImage)) {
                unlink($routeImage);
            }
        }

        $feline->delete();
        return redirect()->route('felines.index');
    }

    public function active($feline)
    {
        $feline = Feline::findOrFail($feline);

        $feline->in_active = 1;
        $feline->save();
        return back()->with('success', 'Michi publicado correctamente');
    }

    /* public function inactive($feline)
    {
        $feline = Feline::findOrFail($feline);

        $advertisement = Advertisement::where('id_feline', $feline->id);

        $advertisement->delete();

        /* $feline->in_active = 0;
        $feline->save(); */

       /*  return back()->with('success', 'Michi despublicado correctamente'); */

}
