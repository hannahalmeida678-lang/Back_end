<?php
declare(strict_types=1);

session_start();

if (!isset($_SESSION['tentativas_login'])) {
    $_SESSION['tentativas_login'] = 0;
}

// Inicializa o tempo de bloqueio
if (!isset($_SESSION['bloqueio_ate'])) {
    $_SESSION['bloqueio_ate'] = 0;
}

// Verifica se ainda está bloqueado
$tempoRestante = $_SESSION['bloqueio_ate'] - time();

if ($tempoRestante > 0) {

    echo "<h2>Login temporariamente bloqueado!</h2>";
    echo "<p>Tente novamente em: " . $tempoRestante . " segundos.</p>";

    exit;
}

// Se o tempo acabou, libera novas tentativas
if ($_SESSION['bloqueio_ate'] > 0) {
    $_SESSION['tentativas_login'] = 0;
    $_SESSION['bloqueio_ate'] = 0;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $senhaDigitada = $_POST['senha'] ?? '';

    // Senha de exemplo para teste
    $senhaCorreta = 'Maria@123';

    if ($senhaDigitada === $senhaCorreta) {

        // Zera o contador
        $_SESSION['tentativas_login'] = 0;
        $_SESSION['bloqueio_ate'] = 0;

        echo "<h2>Login realizado com sucesso!</h2>";

    } else {

        // Incrementa uma tentativa
        $_SESSION['tentativas_login']++;

        echo "<p>Senha incorreta!</p>";

        // Verifica se atingiu 3 tentativas
        if ($_SESSION['tentativas_login'] >= 3) {

            // Bloqueia por 60 segundos
            $_SESSION['bloqueio_ate'] = time() + 60;

            echo "<h2>Você errou 3 vezes!</h2>";
            echo "<p>Login bloqueado por 60 segundos.</p>";

        } else {

            echo "<p>Tentativas restantes: "
                . (3 - $_SESSION['tentativas_login'])
                . "</p>";
        }
    }
}

?>

<!-- Formulário de login -->
<h2>Área de Login</h2>

<form method="POST">

    <label>Senha:</label>

    <input type="password" name="senha" required>

    <button type="submit">Entrar</button>

</form>