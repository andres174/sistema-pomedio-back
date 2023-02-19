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
            
            array_push($finalArray, ["n1" => (float)$varAux[0], "n2" => (float)$varAux[1], "n3" => (float)$varAux[2], "n4" => (float)$varAux[3], "examen" => (float)$varAux[4]]);

            $value->calificaciones = $finalArray;
        }

        return response()->json($estConNota, 200);

    }

    public function getEstudiantesSinProm(){

        $estNota = DB::table('estudiantes')
        ->join('notas', 'estudiantes.id', '=', 'notas.id_estudiante')
        ->select('estudiantes.*', 'notas.id as id_notas', 'notas.calificaciones', 'notas.id_estudiante')
        ->get();

        $separador = ",";
        
        foreach ($estNota as $key => $value) {

            $finalArray = Array();

            $varAux = explode($separador, $value->calificaciones);
            
            array_push($finalArray, ["n1" => (float)$varAux[0], "n2" => (float)$varAux[1], "n3" => (float)$varAux[2], "n4" => (float)$varAux[3], "examen" => (float)$varAux[4]]);

            $value->calificaciones = $finalArray;
        }

        $estSinProm = Array();

        foreach ($estNota as $key => $value) {
            
            if(!DB::table('proms')->where('id_notas', $value->id_notas)->exists()){
                array_push($estSinProm, $value);
            }
 
        }

        return response()->json($estSinProm, 200);

    }

    public function getEstudiantesConProm(){

        $estProm = DB::table('estudiantes')
        ->join('notas', 'estudiantes.id', '=', 'notas.id_estudiante')
        ->join('proms', 'notas.id', '=', 'proms.id_notas')
        ->select('estudiantes.*', 'notas.calificaciones', 'proms.promedio')
        ->get();

        $separador = ",";
        
        foreach ($estProm as $key => $value) {

            $finalArray = Array();

            $varAux = explode($separador, $value->calificaciones);
            
            array_push($finalArray, ["n1" => (float)$varAux[0], "n2" => (float)$varAux[1], "n3" => (float)$varAux[2], "n4" => (float)$varAux[3], "examen" => (float)$varAux[4]]);

            $value->calificaciones = $finalArray;
        }

        return response()->json($estProm, 200);

    }



}
