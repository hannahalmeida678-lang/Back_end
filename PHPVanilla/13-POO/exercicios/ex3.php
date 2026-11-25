<?php
declare(strict_types=1);

class Transacao {
    private string $tipo;
    private float $valor;
    private string $dataHora;
    private bool $sucesso;

    public function __construct(string $tipo, float $valor, string $dataHora, bool $sucesso) {
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->dataHora = $dataHora;
        $this->sucesso = $sucesso;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public function getValor(): float {
        return $this->valor;
    }

    public function getDataHora(): string {
        return $this->dataHora;
    }

    public function isSucesso(): bool {
        return $this->sucesso;
    }
}

class ContaBancaria {
    private float $saldo;
    protected array $transacoes = [];

    public function __construct(float $saldoInicial = 0.0) {
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): bool {
        if ($valor <= 0) {
            return false;
        }

        $this->saldo += $valor;

        $this->transacoes[] = new Transacao(
            "Depósito",
            $valor,
            date("d/m/Y H:i:s"),
            true
        );

        return true;
    }

    public function sacar(float $valor): bool {
        if ($valor <= 0 || $valor > $this->saldo) {
            $this->transacoes[] = new Transacao(
                "Saque",
                $valor,
                date("d/m/Y H:i:s"),
                false
            );

            return false;
        }

        $this->saldo -= $valor;

        $this->transacoes[] = new Transacao(
            "Saque",
            $valor,
            date("d/m/Y H:i:s"),
            true
        );

        return true;
    }

    public function getExtrato(): array {
        return $this->transacoes;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }

    public function gerarExtrato(): void {
        echo "<table border='1'>";
        echo "<tr>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Data/Hora</th>
                <th>Status</th>
              </tr>";

        foreach ($this->getExtrato() as $transacao) {
            echo "<tr>";
            echo "<td>" . $transacao->getTipo() . "</td>";
            echo "<td>R$ " . number_format($transacao->getValor(), 2, ',', '.') . "</td>";
            echo "<td>" . $transacao->getDataHora() . "</td>";
            echo "<td>" . ($transacao->isSucesso() ? "Sucesso" : "Falhou") . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        echo "<h3>Saldo consolidado: R$ "
            . number_format($this->getSaldo(), 2, ',', '.')
            . "</h3>";
    }
}

// Exemplo de utilização
$conta = new ContaBancaria(1000.00);

$conta->depositar(500.00);
$conta->sacar(200.00);
$conta->sacar(1500.00);
$conta->depositar(100.00);

$conta->gerarExtrato();
?>