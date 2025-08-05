<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Municipio;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    public function index()
    {
        $centros = Centro::with('municipio')->get();
        return view('centro.index', compact('centros'));
    }

    public function create()
    {
        $municipios = Municipio::all();
        return view('centro.create', compact('municipios'));
    }

    public function edit($id)
    {
        $centro = Centro::findOrFail($id);
        $municipios = Municipio::all();
        return view('centro.edit', compact('centro', 'municipios'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'nombre_centro' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'municipio_id' => 'required|exists:municipios,id_municipio',
            ]);
            $datos = $request->all();
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
        Centro::create($datos);
        return redirect()->route('centro.index')->with('success', 'Centro creado exitosamente');
    }

    public function show($id)
    {
        try {
            $centro = Centro::with('municipio')->findOrFail($id);
            return response()->json($centro);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Centro no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $centro = Centro::findOrFail($id);
            $request->validate([
                'nombre_centro' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'municipio_id' => 'required|exists:municipios,id_municipio',
            ]);
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            $centro->update($datos);
        return redirect()->route('centro.index')->with('success', 'Centro actualizado exitosamente');
    }

    public function destroy($id)
    {
        try {
            $centro = Centro::findOrFail($id);
            $centro->delete();
            return response()->json([
                'message' => 'Centro eliminado exitosamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el centro',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 