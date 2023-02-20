<?php

namespace App\Http\Controllers;

use App\Models\Prom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromController extends Controller
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
            'promedio' => 'required',
            'id_notas' => 'required'
        ]);

        $promedio = Prom::create([
            'promedio' => $validData['promedio'],
            'id_notas' => $validData['id_notas'],
            'estado' => 1
        ]);

        return response()->json(['message' => 'Promedio registrado.'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Prom $prom): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prom $prom): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prom $prom): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prom $prom): RedirectResponse
    {
        //
    }
}
