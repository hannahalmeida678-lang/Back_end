
<?php

declare(strict_types=1);

require_once 'ContaBancaria.php';
require_once 'ContaCorrente.php';

class ContaInvestimento extends ContaBancaria {

    private float $taxaAdministracao;

    public function __construct(float $saldoInicial = 0.0) {
        parent::__construct($saldoInicial);

        $this->atualizarTaxaAdministracao();
    }

    // Taxa de administração regressiva
    private function atualizarTaxaAdministracao(): void {
        $saldo = $this->getSaldo();

        if ($saldo < 1000) {
            $this->taxaAdministracao = 0.01; // 1%
        } elseif ($saldo < 10000) {
            $this->taxaAdministracao = 0.0075; // 0,75%
        } elseif ($saldo < 50000) {
            $this->taxaAdministracao = 0.005; // 0,5%
        } else {
            $this->taxaAdministracao = 0.0025; // 0,25%
        }
    }

    public function getTaxaAdministracao(): float {
        return $this->taxaAdministracao;
    }

    // IOF simplificado para fins didáticos
    private function calcularIOF(float $rendimento, int $dias): float {
        if ($dias >= 30 || $rendimento <= 0) {
            return 0;
        }

        $percentualIOF = (30 - $dias) / 30;

        return $rendimento * $percentualIOF;
    }

    // IR regressivo simplificado para fins didáticos
    private function calcularIR(float $rendimento, int $dias): float {
        if ($rendimento <= 0) {
            return 0;
        }

        if ($dias <= 180) {
            $aliquota = 0.225; // 22,5%
        } elseif ($dias <= 360) {
            $aliquota = 0.20; // 20%
        } elseif ($dias <= 720) {
            $aliquota = 0.175; // 17,5%
        } else {
            $aliquota = 0.15; // 15%
        }

        return $rendimento * $aliquota;
    }

    public function resgatar(
        float $valor,
        ContaCorrente $contaCorrente,
        float $rendimento = 0.0,
        int $dias = 0
    ): float {

        if ($valor <= 0 || $valor > $this->getSaldo()) {
            throw new ValorInvalidoException(
                "Valor de resgate inválido."
            );
        }

        if ($rendimento < 0 || $dias < 0) {
            throw new ValorInvalidoException(
                "Rendimento ou prazo inválido."
            );
        }

        // Recalcula a taxa conforme o saldo acumulado
        $this->atualizarTaxaAdministracao();

        $taxaAdmin = $valor * $this->taxaAdministracao;

        $iof = $this->calcularIOF($rendimento, $dias);
        $ir = $this->calcularIR($rendimento, $dias);

        $valorLiquido = $valor - $taxaAdmin - $iof - $ir;

        if ($valorLiquido <= 0) {
            throw new ValorInvalidoException(
                "O valor líquido do resgate não é positivo."
            );
        }

        // Retira o valor da conta investimento
        $this->sacar($valor);

        // Transfere o valor líquido para a conta corrente
        $contaCorrente->depositar($valorLiquido);

        return $valorLiquido;
    }
}
