<?php
declare(strict_types=1);
 function contratosPorAno(int $cliente, int $ano)
{
    $contratos = contratos()::where('cliente_id', $cliente)
        ->whereYear('created_at', $ano)
        ->get();

    return view('contratos.index', compact('contratos'));
}

use App\Http\Controllers\ClienteController;
use App\Models\Cliente;

Route::get("cliente/{cliente}/contratos/{ano}",[
    ClienteController::class, "ContratoPorAno"
])

->whereNumber("Cliente")
->where("ano", "[0-9]{4}");


