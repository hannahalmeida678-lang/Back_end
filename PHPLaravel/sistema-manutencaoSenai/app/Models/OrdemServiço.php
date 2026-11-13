<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServiço extends Model
{
     protected $fillable = [
        "codigo", "titulo", "equipamento_id", "tipo", "rpioridade", "status", "tecnico", "data_abertura", "prazo_limite"
    ];
}
