<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Centro;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index()
    {
            $sedes = Sede::with('centro')->get();
        return view('sede.index', compact('sedes'));
        }

    public function create()
    {
        $centros = Centro::all();
        return view('sede.create', compact('centros'));
    }

    public function edit($id)
    {
        $sede = Sede::findOrFail($id);
        $centros = Centro::all();
        return view('sede.edit', compact('sede', 'centros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_sede' => 'required|string|max:255',
            'direccion_sede' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'centro_id' => 'required|exists:centros,id_centro',
        ]);
        $datos = $request->all();
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
        Sede::create($datos);
        return redirect()->route('sede.index')->with('success', 'Sede creada exitosamente');
    }

    public function show($id)
    {
        try {
            $sede = Sede::with('centro')->findOrFail($id);
            return response()->json($sede);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
            $sede = Sede::findOrFail($id);
        $request->validate([
            'nombre_sede' => 'required|string|max:255',
            'direccion_sede' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'centro_id' => 'required|exists:centros,id_centro',
        ]);
        $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            $sede->update($datos);
        return redirect()->route('sede.index')->with('success', 'Sede actualizada exitosamente');
    }

    public function destroy($id)
    {
        try {
            $sede = Sede::findOrFail($id);
            $sede->delete();
            return response()->json([
                'message' => 'Sede eliminada exitosamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la sede',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
