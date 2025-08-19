<?php

namespace App\Http\Controllers;

use App\Models\Sitio;
use App\Models\TipoSitio;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class SitioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sitios = Sitio::with('tipoSitio')->get();
            return view('sitios.index', compact('sitios'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener los sitios: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposSitio = TipoSitio::all();
        return view('sitios.create', compact('tiposSitio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'nombre_sitio' => 'required|string|max:255',
                'ubicacion' => 'required|string|max:255',
                'ficha_tecnica' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            ]);
            
            // Preparar los datos del sitio
            $datos = $request->all();
            
            // Asignar fechas si no están presentes
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
            
            // Crear el sitio
            $sitio = Sitio::create($datos);
            
            // Redireccionar con mensaje de éxito
            return redirect()->route('sitios.index')
                ->with('success', 'Sitio creado exitosamente');
        } catch (\Exception $e) {
            // Redireccionar con mensaje de error
            return back()->with('error', 'Error al crear el sitio: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sitio = Sitio::with('tipoSitio')->findOrFail($id);
            return view('sitios.show', compact('sitio'));
        } catch (\Exception $e) {
            return back()->with('error', 'Sitio no encontrado: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sitio $sitio)
    {
        $tiposSitio = TipoSitio::all();
        return view('sitios.edit', compact('sitio', 'tiposSitio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar el sitio por ID
            $sitio = Sitio::findOrFail($id);
            
            // Validar los datos de entrada
            $request->validate([
                'nombre_sitio' => 'required|string|max:255',
                'ubicacion' => 'required|string|max:255',
                'ficha_tecnica' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            ]);
            
            // Preparar los datos del sitio
            $datos = $request->all();
            
            // Actualizar la fecha de modificación
            $datos['fecha_modificacion'] = now();
            
            // Actualizar el sitio
            $sitio->update($datos);
            
            // Redireccionar con mensaje de éxito
            return redirect()->route('sitios.index')
                ->with('success', 'Sitio actualizado exitosamente');
        } catch (\Exception $e) {
            // Redireccionar con mensaje de error
            return back()->with('error', 'Error al actualizar el sitio: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el sitio por ID
            $sitio = Sitio::findOrFail($id);
            
            // Eliminar el sitio
            $sitio->delete();
            
            // Redireccionar con mensaje de éxito
            return redirect()->route('sitios.index')
                ->with('success', 'Sitio eliminado exitosamente');
        } catch (\Exception $e) {
            // Redireccionar con mensaje de error
            return back()->with('error', 'Error al eliminar el sitio: ' . $e->getMessage());
        }
    }
}
