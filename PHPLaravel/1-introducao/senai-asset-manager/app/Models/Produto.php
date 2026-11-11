<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $filliable = ["codigo", "nome", "fabricante", "estoque", "preco"];
}
