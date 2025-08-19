<?php

namespace App\Http\Controllers;

use App\Models\CategoriaElemento;
use Illuminate\Http\Request;
use App\Http\Middleware\IsUserAuth;

class ElementoController extends Controller
{
    public function index()
    {
        $categorias = \App\Models\CategoriaElemento::all();
        return view('categorias_elementos.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias_elementos.create');
    }

    public function edit($id)
    {
        $categoria = \App\Models\CategoriaElemento::findOrFail($id);
        return view('categorias_elementos.edit', compact('categoria'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'codigo_qnpsc' => 'required|string|max:255',
                'nombre_categoria' => 'required|string|max:255',
                'estado' => 'required|boolean',
            ]);
            $datos = $request->all();
            if (!isset($datos['fecha_creacion'])) {
                $datos['fecha_creacion'] = now();
            }
            if (!isset($datos['fecha_modificacion'])) {
                $datos['fecha_modificacion'] = now();
            }
        $categoria = \App\Models\CategoriaElemento::create($datos);
        return redirect()->route('categorias_elementos.index')->with('success', 'Categoría de elemento creada exitosamente');
    }

    public function show($id)
    {
        try {
            $categoria = CategoriaElemento::findOrFail($id);
            return response()->json($categoria);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Categoría de elemento no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $categoria = \App\Models\CategoriaElemento::findOrFail($id);
            $request->validate([
                'codigo_qnpsc' => 'required|string|max:255',
                'nombre_categoria' => 'required|string|max:255',
                'estado' => 'required|boolean',
            ]);
            $datos = $request->all();
            $datos['fecha_modificacion'] = now();
            $categoria->update($datos);
        return redirect()->route('categorias_elementos.index')->with('success', 'Categoría de elemento actualizada exitosamente');
    }

    public function destroy($id)
    {
        try {
            // Buscar la categoría por ID
            $categoria = CategoriaElemento::findOrFail($id);
            
            // Guardar el nombre para incluirlo en la respuesta
            $nombreCategoria = $categoria->nombre_categoria;
            
            // Eliminar la categoría
            $categoria->delete();
            
            // Devolver mensaje de éxito
            return response()->json([
                'message' => 'Categoría de elemento eliminada exitosamente',
            ], 200);

            
        } catch (\Exception $e) {
            // Devolver error con detalles
            return response()->json([
                'message' => 'Error al eliminar la categoría de elemento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
