<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
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
            'calificaciones' => 'required|string',
            'id_estudiante' => 'required'
        ]);

        $nota = Nota::create([
            'calificaciones' => $validData['calificaciones'],
            'id_estudiante' => $validData['id_estudiante'],
            'estado' => 1
        ]);

        return response()->json(['message' => 'Notas registradas.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nota $nota): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nota $nota): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota): RedirectResponse
    {
        //
    }
}
