
<?php
declare(strict_types=1);

final class Produto{
    private array $produtos = [
        ['id' => 1, 'nome' => 'Torno CNC', 'categoria' => 'Usinagem'],
        ['id' => 2, 'nome' => 'Fresa', 'categoria' => 'Usinagem'],
        ['id' => 3, 'nome' => 'Furadeira', 'categoria' => 'Perfuração'],
        ['id' => 4, 'nome' => 'Prensa', 'categoria' => 'Estamparia'],
        ['id' => 5, 'nome' => 'Broca', 'categoria' => 'Perfuração']
    ];

    public function buscarPorCategoria(string $categoria): array
    {
        return array_filter(
            $this->produtos,
            function ($produto) use ($categoria) {
                return $produto['categoria'] === $categoria;
            }
        );
    }
}
