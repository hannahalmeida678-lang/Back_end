
<?php

echo "===== INSPETOR FORENSE DE HASH =====\n";

// Recebe a senha
echo "Digite uma senha: ";
$senha = trim(fgets(STDIN));

// Gera o hash utilizando Argon2id
$hash = password_hash($senha, PASSWORD_ARGON2ID);

// Exibe o hash completo
echo "Hash gerado:";
echo $hash . "";

// Divide o hash em partes usando $
$partes = explode("$", $hash);

// Exibe cada informação
echo "===== DECOMPOSIÇÃO DO HASH =====";

echo "Algoritmo: " . $partes[1] . "";

echo "Versão: " . $partes[2] . "";

// Divide os custos usando vírgula
$custos = explode(",", $partes[3]);

echo "Custo de memória: " . $custos[0] . "";
echo "Custo de tempo: " . $custos[1] . "";
echo "Custo de paralelismo: " . $custos[2] . "";

echo "Salt codificado: " . $partes[4] . "";

echo "Hash final: " . $partes[5] . "";

echo "===== FIM DA ANÁLISE =====";

?>
