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
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'nullable|string',
            'dimension' => 'nullable|string',
            'tecnique' => 'nullable|string',
            'date' => 'nullable|string',
            'price' => 'nullable|string',
            'imgPath' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/uploads');
            $validated['imgPath'] = $path;
        }

        Opera::create($validated);

        return response()->json([
            'message' => 'Opera aggiunta con successo',
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
    public function destroy(string $id)
    {
        //
    }
}
