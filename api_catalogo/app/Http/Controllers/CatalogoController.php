<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    // GET /api/catalogos - Listar todos
    public function index()
    {
        $catalogos = Catalogo::all();
        return response()->json($catalogos);
    }

    // GET /api/catalogos/{id} - Listar uno
    public function show($id)
    {
        $catalogo = Catalogo::findOrFail($id);
        return response()->json($catalogo);
    }

    // POST /api/catalogos - Crear nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'estado' => 'nullable|string'
        ]);

        $catalogo = Catalogo::create($request->all());
        return response()->json($catalogo, 201);
    }

    // PUT/PATCH /api/catalogos/{id} - Actualizar
    public function update(Request $request, $id)
    {
        $catalogo = Catalogo::findOrFail($id);
        
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'estado' => 'nullable|string'
        ]);

        $catalogo->update($request->all());
        return response()->json($catalogo);
    }

    // DELETE /api/catalogos/{id} - Eliminar
    public function destroy($id)
    {
        $catalogo = Catalogo::findOrFail($id);
        $catalogo->delete();
        return response()->json(null, 204);
    }
}
