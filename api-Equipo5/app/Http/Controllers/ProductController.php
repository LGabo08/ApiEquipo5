<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()  { return response()->json(['message' => 'Listado de productos']); }
    public function store(Request $r)  { return response()->json(['message' => 'Producto creado'], 201); }
    public function show($id) { return response()->json(['message' => "Producto #$id"]); }
    public function update(Request $r, $id) { return response()->json(['message' => "Producto #$id actualizado"]); }
    public function destroy($id) { return response()->json(null, 204); }
}
