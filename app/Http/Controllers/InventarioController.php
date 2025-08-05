<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Sitio;
use App\Models\Material;
use Illuminate\Http\Request;
use Exception;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $inventarios = Inventario::with(['sitio', 'material'])->get();
            return view('inventario.index', compact('inventarios'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener la lista de inventario: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sitios = Sitio::all();
        $materiales = Material::all();
        return view('inventario.create', compact('sitios', 'materiales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'stock' => 'required|integer',
                'placa_sena' => 'required|string',
                'descripcion' => 'required|string',
                'sitio_id' => 'required|exists:sitios,id_sitio',
            ]);

            $inventario = Inventario::create($request->all());
            
            return redirect()->route('inventario.index')
                ->with('success', 'Elemento de inventario creado correctamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al crear el elemento de inventario: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $inventario = Inventario::with('sitio')->find($id);
            
            if (!$inventario) {
                return back()->with('error', 'Elemento de inventario no encontrado');
            }
            
            return view('inventario.show', compact('inventario'));
        } catch (Exception $e) {
            return back()->with('error', 'Error al obtener el elemento de inventario: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        $sitios = Sitio::all();
        return view('inventario.edit', compact('inventario', 'sitios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $inventario = Inventario::find($id);
            
            if (!$inventario) {
                return back()->with('error', 'Elemento de inventario no encontrado');
            }
            
            $request->validate([
                'stock' => 'integer',
                'placa_sena' => 'string',
                'descripcion' => 'string',
                'sitio_id' => 'exists:sitios,id_sitio',
            ]);
            
            $inventario->update($request->all());
            
            return redirect()->route('inventario.index')
                ->with('success', 'Elemento de inventario actualizado correctamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al actualizar el elemento de inventario: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $inventario = Inventario::find($id);
            
            if (!$inventario) {
                return back()->with('error', 'Elemento de inventario no encontrado');
            }
            
            $inventario->delete();
            
            return redirect()->route('inventario.index')
                ->with('success', 'Elemento de inventario eliminado correctamente');
        } catch (Exception $e) {
            return back()->with('error', 'Error al eliminar el elemento de inventario: ' . $e->getMessage());
        }
    }
}
