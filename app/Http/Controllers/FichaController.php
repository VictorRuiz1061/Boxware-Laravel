<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use Illuminate\Http\Request\FichaRequest;
use App\Models\Usuario;
use App\Models\Programa;


class FichaController extends Controller
{
    public function index()
    {
        try {
            $fichas = Ficha::with(['usuario', 'programa'])->get();
            return view('fichas.index', compact('fichas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener las fichas: ' . $e->getMessage());
        }
    }
    
    public function create()
    {
        try {
            $usuarios = Usuario::all();
            $programas = Programa::all();
            return view('fichas.create', compact('programas', 'usuarios'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener datos para crear ficha: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estado' => 'required|boolean',
           'fecha_creacion' => 'nullable|date',
            'fecha_modificacion' => 'nullable|date',
            'usuario_id' => 'required|exists:usuarios,id',
            'programa_id' => 'required|exists:programas,id_programa',
        ]);

        // Asignar fechas si no están presentes
        if (!isset($validated['fecha_creacion'])) {
            $validated['fecha_creacion'] = now();
        }
        if (!isset($validated['fecha_modificacion'])) {
            $validated['fecha_modificacion'] = now();
        }

        $ficha = Ficha::create($validated);
        return response()->json($ficha, 201);
    }

    public function show($id)
    {
        $ficha = Ficha::findOrFail($id);
        return response()->json($ficha);
    }

    public function update(Request $request, $id)
    {
        $ficha = Ficha::findOrFail($id);

        $validated = $request->validate([
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'nullable|date',
            'fecha_modificacion' => 'nullable|date',
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'programa_id' => 'sometimes|exists:programas,id_programa',
        ]);

        $validated['fecha_modificacion'] = now();

        $ficha->update($validated);

        return response()->json($ficha);
    }

    public function destroy($id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->delete();

        return response()->json(['message' => 'Ficha eliminada correctamente']);
    }
}