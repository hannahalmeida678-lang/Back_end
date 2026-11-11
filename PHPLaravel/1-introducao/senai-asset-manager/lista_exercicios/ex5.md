## Exercício 5: Rota de Alteração Parcial com Verbo PATCH
Missão: Mapear a rota PATCH /clientes/{id}/status:
Criar o método alterarStatus(Request $request, int $id) que altera exclusivamente o status do cliente (alternando entre ATIVO e SUSPENSO).
Adicionar um botão rápido n

1. no arquivo `routes\web.php` digite o comando

```php 
use App\Http\Controllers\ClienteController;

Route::patch('/clientes/{id}/status', 
    [ClienteController::class, 'alterarStatus']
)->name('clientes.alterarStatus');
```

2. no arquivo `ClientsController.php` importe

```php 
use Illuminate\Http\Request;
use App\Models\Cliente;
```


3. agora, é só implementar o metodo

```php
public function alterarStatus(Request $request, int $id)
{
    $cliente = Cliente::findOrFail($id);

    if ($cliente->status === 'ATIVO') {
        $cliente->status = 'SUSPENSO';
    } else {
        $cliente->status = 'ATIVO';
    }

    $cliente->save();

    return response()->json([
        'mensagem' => 'Status alterado com sucesso!',
        'cliente' => $cliente->nome,
        'novo_status' => $cliente->status
    ]);
}
```

> obs: do blade, voce pode colocar:
 ```php 
<form action="{{ route('clientes.alterarStatus', $cliente->id) }}"
      method="POST">

    @csrf
    @method('PATCH')

    <button type="submit">
        Alterar Status
    </button>

</form>