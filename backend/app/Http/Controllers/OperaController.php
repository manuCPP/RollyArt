<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opera;

class OperaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Opera::all(), 200, ['Content-Type' => 'application/json']);
    }


public function store(Request $request)
{
    try {


        // Validazione solo dei campi testo
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'dimension' => 'required|string',
            'tecnique' => 'required|string',
            'date' => 'required|string',
            'price' => 'required|string',
            'isSold' => 'required|string',
            // NIENTE 'image' qui
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['imgPath'] = $path;
        }

        // Creazione record
        Opera::create($validated);

        return response()->json([
            'message' => 'Opera aggiunta',
            'data' => $validated
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $opera = Opera::find($id);

        if (!$opera) {
            return response()->json(['message' => 'Opera non trovata'], 404);
        }

        $opera->delete();

        return response()->json(['message' => 'Opera rimossa con successo'], 200);
    }

}
