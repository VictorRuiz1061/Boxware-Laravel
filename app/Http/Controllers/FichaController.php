<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Programa;

/**
 * Class FichaController
 * @package App\Http\Controllers
 */
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
        try {
            $validated = $request->validate([
                'id_ficha' => 'required|unique:fichas,id_ficha',
                'estado' => 'required|boolean',
                'usuario_id' => 'required|exists:usuarios,id_usuario',
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
            return redirect()->route('fichas.index')->with('success', 'Ficha creada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear la ficha: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $ficha = Ficha::findOrFail($id);
        return response()->json($ficha);
    }
    
    public function edit($id)
    {
        try {
            $ficha = Ficha::findOrFail($id);
            $usuarios = Usuario::all();
            $programas = Programa::all();
            return view('fichas.edit', compact('ficha', 'usuarios', 'programas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener datos para editar ficha: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ficha = Ficha::findOrFail($id);

            $validated = $request->validate([
                'estado' => 'sometimes|boolean',
                'usuario_id' => 'required|exists:usuarios,id_usuario',
                'programa_id' => 'required|exists:programas,id_programa',
            ]);

            $validated['fecha_modificacion'] = now();

            $ficha->update($validated);

            return redirect()->route('fichas.index')
                ->with('success', 'Ficha actualizada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la ficha: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->delete();

        return response()->json(['message' => 'Ficha eliminada correctamente']);
    }
}
