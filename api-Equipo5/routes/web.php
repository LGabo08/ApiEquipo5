<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Ruta original (no la borres)
Route::get('/', function () {
    return view('welcome');
});

// #22: Endpoint GET /products
Route::get('/products', function () {
    $productos = DB::table('products')->select('id','nombre','precio','stock')->get();
    return response()->json($productos);
});

// #23: Endpoint POST /sales
Route::post('/sales', function (Request $request) {
    $data = $request->validate([
        'total' => 'required|numeric|min:1',
        'fecha' => 'nullable|date'
    ]);

    DB::table('sales')->insert([
        'total' => $data['total'],
        'fecha' => $data['fecha'] ?? now(),
    ]);

    return response()->json(['ok' => true, 'message' => 'Venta registrada correctamente']);
});

// #24: Endpoint PUT /inventory/update
Route::put('/inventory/update', function (Request $request) {
    $data = $request->validate([
        'id_producto' => 'required|integer|exists:products,id',
        'cantidad' => 'required|integer|min:1'
    ]);

    DB::table('products')
        ->where('id', $data['id_producto'])
        ->decrement('stock', $data['cantidad']);

    return response()->json(['ok' => true, 'message' => 'Inventario actualizado']);
});
