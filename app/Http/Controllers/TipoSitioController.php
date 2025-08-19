<?php

namespace App\Http\Controllers;

use App\Models\TipoSitio;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class TipoSitioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposSitio = \App\Models\TipoSitio::all();
        return view('tipos_sitio.index', compact('tiposSitio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipos_sitio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'nombre_tipo_sitio' => 'required|string|max:255',
                'estado' => 'required|boolean',
            ]);
            $datos = $request->all();
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
        $tipoSitio = \App\Models\TipoSitio::create($datos);
        return redirect()->route('tipos_sitio.index')->with('success', 'Tipo de sitio creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $tipoSitio = TipoSitio::with('sitios')->findOrFail($id);
            return response()->json($tipoSitio);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Tipo de sitio no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipoSitio = \App\Models\TipoSitio::findOrFail($id);
        return view('tipos_sitio.edit', compact('tipoSitio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipoSitio = \App\Models\TipoSitio::findOrFail($id);
            $request->validate([
                'nombre_tipo_sitio' => 'required|string|max:255',
                'estado' => 'required|boolean',
            ]);
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            $tipoSitio->update($datos);
        return redirect()->route('tipos_sitio.index')->with('success', 'Tipo de sitio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el tipo de sitio por ID
            $tipoSitio = TipoSitio::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreTipoSitio = $tipoSitio->nombre_tipo_sitio;
            
            // Eliminar el tipo de sitio
            $tipoSitio->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Tipo de sitio eliminado exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el tipo de sitio',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
