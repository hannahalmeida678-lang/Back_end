
### a atividade solicita a seguite codigo:

```php
<?php 
declare(strict_types=1);

Route::resource('fornecedores', FornecedorController::class)->only(['index', 'show']);
```

2. no bash, deve-se digitar o seguinte

```bash
php artisan route:list --path=fornecedores
```

digitando no bash, aparecerá a seguinte mensagem

```bash
GET|HEAD   fornecedores ........ fornecedores.index
GET|HEAD   fornecedores/{fornecedore} fornecedores.show

Showing [2] routes
```
