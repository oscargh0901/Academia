<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumnos::orderBy('id')->paginate(5);

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mail' => ['required'],
            'telefono' => ['nullable']
        ]);
        $alumnos = new Alumnos();
        $alumnos->nombre = ucwords($request->nombre);
        $alumnos->apellidos = ucwords($request->apellidos);
        $alumnos->mail = $request->mail;
        $alumnos->telefono = $request->telefono;
        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            $file = $request->file('foto');
            $nom = 'foto/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nom, \File::get($file));
            $alumnos->foto = "img/$nom";
        }
        $alumnos->save();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $alumnos)
    {
        //No es necesario la visuallización de detalles
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnos $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnos $alumno)
    {
        $request->validate([
            'mail' => ['required'],
            'telefono' => ['nullable']
        ]);

        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            $file = $request->file('foto');
            $nombre = 'alumnos/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            if (basename($nombre->foto) != 'default.png') {
                unlink($nombre->foto);
            }
            $alumno->update($request->all());
            $alumno->update(['foto' => "img/$nombre"]);
        } else {
            $alumno->update($request->all());
        }
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnos $alumno)
    {
        $foto = $alumno->foto;
        if (basename($foto) != 'default.png') {
            unlink($alumno->foto);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno borrado');
    }
}
