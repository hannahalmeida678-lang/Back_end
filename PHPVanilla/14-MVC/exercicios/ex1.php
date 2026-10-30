<?php 
declare(strict_types=1);
final class produtoControler{
    private array $produtos = [
        1 => ['id' => 1, 'nome' => 'Notebook'],
        2 => ['id' => 2, 'nome' => 'Mouse'],
        3 => ['id' => 3, 'nome' => 'Teclado']
    ];
    public function detalhar(int $id): void{
    if(!isset($this->produto[$id])) {
        http_response_code(404);
        echo "404- não encontrado";
        return;
    }
    $produto =$this->produtos[$id];
    }
}