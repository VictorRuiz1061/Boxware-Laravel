<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Requests\MunicipioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = \App\Models\Municipio::all();
        return view('municipio.index', compact('municipios'));
    }

    public function create()
    {
        return view('municipio.create');
    }

    public function edit($id)
    {
        $municipio = \App\Models\Municipio::findOrFail($id);
        return view('municipio.edit', compact('municipio'));
    }
 
    public function store(MunicipioRequest $request)
    {
        $validated = $request->validated([
            'nombre_municipio' => 'required',
            'estado' => 'required',
        ]);
        $datos = $request->all();
        if (!isset($datos['fecha_creacion'])) {
            $datos['fecha_creacion'] = now();
        }
        if (!isset($datos['fecha_modificacion'])) {
            $datos['fecha_modificacion'] = now();
        }
        $municipio = \App\Models\Municipio::create($datos);
        return redirect()->route('municipios.index')->with('success', 'Municipio creado exitosamente');
    }

    public function show($id)
    {
        try{
            $municipio = Municipio::findOrFail($id);
            return response()->json($municipio);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Municipio no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $municipio = \App\Models\Municipio::findOrFail($id);
        $request->validate([
            'nombre_municipio' => 'required',
            'estado' => 'required',
        ]);
        $datos = $request->all();
        $datos['fecha_modificacion'] = now();
        $municipio->update($datos);
        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado exitosamente');
    }

    public function destroy($id)
    {
        try {
            // Buscar el municipio por ID
            $municipio = Municipio::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreMunicipio = $municipio->nombre_municipio;
            
            // Eliminar el municipio
            $municipio->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Municipio eliminado exitosamente'
            ], 200);
            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el municipio',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
