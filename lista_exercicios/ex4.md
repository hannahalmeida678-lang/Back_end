# Missão: Criar um grupo de rotas com prefixo /admin e nome admin.:

## Rota GET /admin/auditoria/clientes apontando para método que lista a quantidade total de parceiros ativos, Testar a geração da URL através de route('admin.auditoria.clientes').

1. criando rotas

```php
use App\Http\Controllers\AdminController;
route::prefix("admin")
->name("admin")
->group(function () {

        Route::get('/auditoria/clientes', 
            [AdminController::class, 'auditoriaClientes']
        )->name('auditoria.clientes');

    });
```

no bash:

```bash
php artisan make:controller adminController
```

depois de criado, devese por:

```php


public function auditoriaClientes()
{
    $totalAtivos = Parceiro::where('ativo', true)->count();

    return response()->json([
        'total_parceiros_ativos' => $totalAtivos
    ]);
}
```
