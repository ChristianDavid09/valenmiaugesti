<?php
/**
 * @author: David Murillo
 * @version: 1.0
 * @since: 05-03-2025
 */
namespace App\Http\Controllers;

use App\Models\Feline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormFeline;
use App\Http\Controllers\AdvertisementController;
use App\Models\Advertisement;


class FelineController extends Controller
{
    public function index()
{
    $cologne = Auth::user()->cologne;

    /*
     * Obtenemos los IDs de los felinos que tienen anuncios.
     */
    $advertisementsQuery = Advertisement::whereHas('feline', function ($query) use ($cologne) {
        $query->where('id_cologne', $cologne->id);
    })->orderBy('created_at', 'asc');

    /*
     * Si la colonia es BASIC, solo obtenemos los 3 primeros anuncios.
     */
    if ($cologne->t_user === 'basic') {

        $publishedFelineIds = $advertisementsQuery
            ->take(3)
            ->pluck('id_feline');

    } else {

        /*
         * PREMIUM puede tener todos los anuncios publicados.
         */
        $publishedFelineIds = $advertisementsQuery
            ->pluck('id_feline');
    }

    /*
     * Michis publicados:
     * Solo los que pertenecen a los anuncios visibles.
     */
    $activeFelines = $cologne->felines()
        ->whereIn('id', $publishedFelineIds)
        ->paginate(6, ['*'], 'activos');

    /*
     * Michis no publicados:
     * Los demás felinos de la colonia.
     */
    $inactiveFelines = $cologne->felines()
        ->whereNotIn('id', $publishedFelineIds)
        ->paginate(6, ['*'], 'inactivos');

    return view(
        'feline.index',
        compact('activeFelines', 'inactiveFelines')
    );
}
    public function create()
    {
        return view('feline.create');
    }

    public function store(FormFeline $request): RedirectResponse
    {

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

            // Creamos un nombre propio para la foto del michi
            $photo = $request->file('image');
            $timeForFile = now()->timestamp;
            $extension = $photo->getClientOriginalExtension();
            $filePhoto =  $request->input('name') . '.' .$request->input('race').'.'. $timeForFile. '.' . $extension;

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

    public function show(Feline $feline)
    {
        // Verificamos si el usuario autenticado es el propietario del michi
        // De esta manera, en la vista podemos mostrar el botón de editar y eliminar
        // solo si el usuario es el propietario del michi.
        $isOwner = Auth::check() && Auth::user()->rol === 'Cologne' && $feline->id_cologne === Auth::user()->cologne->id;
        return view('feline.show', compact('feline', 'isOwner'));

    }

    public function edit(Feline $feline)
    {
        // Verificar si el usuario autenticado es el propietario del michi
        if (Auth::user()->rol == "Cologne") {
            if ($feline->id_cologne !== Auth::user()->cologne->id) {
                abort(403, 'No tienes permiso para modificar este michi.');
            }
        } else {
            abort(403, 'No tienes permiso para modificar este michi.');
        }


        return view ('feline.edit', ['feline' => $feline]);
    }


    public function update(FormFeline $request, Feline $feline)
    {

        $feline->name = $request->input('name');
        $feline->race = $request->input('race');
        $feline->sex = $request->input('sex');
        $feline->health_status = $request->input('health_status');
        $feline->sterilized = $request->input('sterilized');
        $feline->id_cologne = Auth::user()->cologne->id;


        //Hacemos comprobacionees, si el campo es nulo, vacío o no es un entero, lo dejamos como nulo
        if($request->input('age') === null || $request->input('age') === '' || !is_numeric($request->input('age'))) {
            $feline->age = null;
        } else {
            $feline->age = $request->input('age');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $photo = $request->file('image');
            // Si el michi no tiene foto, creamos un nombre propio para la foto del michi
            // Si el michi ya tiene foto, usamos el nombre de la foto existente
            // para sobreescribirla y no llenar el directorio de fotos.
            if($feline->photo === null) {
                $timeForFile = now()->timestamp;
                $extension = $photo->getClientOriginalExtension();
                $filePhoto =  $request->input('name') . '.' .$request->input('race').'.'. $timeForFile. '.' . $extension;
            } else {
                $filePhoto = $feline->photo;
            }

            $routeImage = public_path('images/colognes/felines');

            $photo->move($routeImage, $filePhoto);

            $feline->photo = $filePhoto;

        }

        $feline->save();
        return redirect()->route('felines.index')->with('success', 'Michi actualizado correctamente.');
    }

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
    

}
