<?php
declare(strict_types=1);

require_once 'ContaBancaria.php';

$violacoesBloqueadas = 0;
$totalTestes = 3;

echo "========================================\n";
echo " TESTE DE INTEGRIDADE E ENCAPSULAMENTO\n";
echo "========================================\n\n";

// 1. Tentativa de alterar atributo privado
echo "[TESTE 1] Tentativa de acesso a atributo privado...\n";

try {
    $conta = new ContaBancaria();

    // Ajuste o nome da propriedade conforme sua classe
    $conta->saldo = 999999.99;

    echo "FALHA: O acesso direto foi permitido!\n";

} catch (Throwable $e) {
    $violacoesBloqueadas++;

    echo "BLOQUEADO: " . get_class($e) . "\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
}

// 2. Tentativa de instanciar classe abstrata
echo "\n[TESTE 2] Tentativa de instanciar classe abstrata...\n";

try {
    $contaAbstrata = new ContaBancaria();

    echo "FALHA: A instanciação foi permitida!\n";

} catch (Throwable $e) {
    $violacoesBloqueadas++;

    echo "BLOQUEADO: " . get_class($e) . "\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
}

// 3. Tentativa de depósito negativo
echo "\n[TESTE 3] Tentativa de depósito negativo...\n";

try {
    $conta = new ContaBancaria();

    $conta->depositar(-100.00);

    echo "FALHA: O depósito negativo foi permitido!\n";

} catch (ValorInvalidoException $e) {
    $violacoesBloqueadas++;

    echo "BLOQUEADO: ValorInvalidoException\n";
    echo "Mensagem: " . $e->getMessage() . "\n";

} catch (Throwable $e) {
    echo "ERRO INESPERADO: " . get_class($e) . "\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
}

// Relatório final
echo "\n========================================\n";
echo " RELATORIO FINAL DE SEGURANCA\n";
echo "========================================\n";

echo "Testes executados: $totalTestes\n";
echo "Violacoes bloqueadas: $violacoesBloqueadas\n";

if ($violacoesBloqueadas === $totalTestes) {
    echo "RESULTADO: BLINDAGEM APROVADA!\n";
    echo "100% das tentativas foram bloqueadas.\n";
} else {
    echo "RESULTADO: BLINDAGEM INCOMPLETA!\n";
    echo "Nem todas as tentativas foram bloqueadas.\n";
}

echo "========================================\n";

?>