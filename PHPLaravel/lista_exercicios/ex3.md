
dentro do aquivo execute o comando:

```php 

declare(strict_types=1);

use Illuminate\Http\Request;
 function origemRequisição(request $request){
    $ip = $request->ip();

    $userAgent = $request->userAgent();

    return response()->json([
        "ip" => $ip,
        "user_agent" = $userAgent
    ]);
}

```

no aquivo web.php, digite esse comando:

```php
Route::get('/clientes/origem-requisicao', 
    [ClienteController::class, 'origemRequisicao']
);
```