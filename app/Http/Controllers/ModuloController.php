<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class ModuloController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulos = \App\Models\Modulo::all();
        return view('modulos.index', compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulosPadre = \App\Models\Modulo::whereNull('modulo_padre_id')->get();
        return view('modulos.create', compact('modulosPadre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rutas' => 'required',
            'descripcion_ruta' => 'required',
            'mensaje_cambio' => 'nullable',
            'imagen' => 'nullable',
            'estado' => 'required|boolean',
            'es_submenu' => 'required|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
        ]);
        \App\Models\Modulo::create($validated);
        return redirect()->route('modulos.index')->with('success', 'Módulo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $modulo = Modulo::with(['submodulos', 'moduloPadre'])->findOrFail($id);
            return response()->json($modulo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Módulo no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modulo = \App\Models\Modulo::findOrFail($id);
        $modulosPadre = \App\Models\Modulo::whereNull('modulo_padre_id')->get();
        return view('modulos.edit', compact('modulo', 'modulosPadre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $modulo = \App\Models\Modulo::findOrFail($id);
        $validated = $request->validate([
            'rutas' => 'required',
            'descripcion_ruta' => 'required',
            'mensaje_cambio' => 'nullable',
            'imagen' => 'nullable',
            'estado' => 'required|boolean',
            'es_submenu' => 'required|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
        ]);
        $modulo->update($validated);
        return redirect()->route('modulos.index')->with('success', 'Módulo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el módulo por ID
            $modulo = Modulo::findOrFail($id);
            
            // Guardar información para incluirla en la respuesta
            $descripcionModulo = $modulo->descripcion_ruta;
            
            // Eliminar el módulo
        $modulo->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Módulo eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar el módulo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
