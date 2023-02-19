<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $estudiantes = Estudiante::where('estado', 1)->get();
        return response()->json($estudiantes, 200);
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
        $validData = $request->validate([
            'nombre' => 'required|string'
        ]);

        $estudiante = Estudiante::create([
            'nombre' => $validData['nombre'],
            'estado' => 1
        ]);

        return response()->json(['message' => 'Estudiante registrado.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function getEstudiantesSinNota(){

        $estAll = DB::table('estudiantes')
        ->where('estado', 1)
        ->get();

        $estSinNota = Array();

        foreach ($estAll as $key => $value) {
            
            if(!DB::table('notas')->where('id_estudiante', $value->id)->exists()){
                array_push($estSinNota, $value);
            }
 
        }

        return response()->json($estSinNota, 200);

    }

    public function getEstudiantesConNota(){

        $estConNota = DB::table('estudiantes')
        ->join('notas', 'estudiantes.id', '=', 'notas.id_estudiante')
        ->select('estudiantes.*', 'notas.*')
        ->get();

        $separador = ",";
        
        foreach ($estConNota as $key => $value) {

            $finalArray = Array();

            $varAux = explode($separador, $value->calificaciones);
            
            array_push($finalArray, ["n1" => $varAux[0]], ["n2" => $varAux[1]], ["n3" => $varAux[2]], ["n4" => $varAux[3]], ["examen" => $varAux[4]]);

            $value->calificaciones = $finalArray;
        }

        return response()->json($estConNota, 200);

    }
}
