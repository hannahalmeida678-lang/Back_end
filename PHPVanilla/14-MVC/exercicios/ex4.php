
<?php
declare(strict_types=1);

final class Produto
{
    private array $produtos = [
        1 => ['id' => 1, 'nome' => 'Aço'],
        2 => ['id' => 2, 'nome' => 'Cobre'],
        3 => ['id' => 3, 'nome' => 'Alumínio']
    ];

    public function excluir(int $id): bool
    {
        if (!isset($this->produtos[$id])) {
            return false;
        }

        unset($this->produtos[$id]);

        return true;
    }
}
