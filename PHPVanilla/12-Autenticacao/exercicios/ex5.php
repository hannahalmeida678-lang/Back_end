
<?php

require_once 'config/conexao.php';

function registrarAuditoria(
    PDO $pdo,
    string $email,
    bool $sucesso
): void {

    // Captura o IP do cliente
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Desconhecido';

    // Captura o navegador
    $navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconhecido';

    // SQL para registrar a tentativa
    $sql = "INSERT INTO auditoria_logins
            (email, ip, user_agent, sucesso, data_hora)
            VALUES (:email, :ip, :user_agent, :sucesso, CURRENT_TIMESTAMP)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':ip' => $ip,
        ':user_agent' => $navegador,
        ':sucesso' => $sucesso
    ]);
}

// Exemplo de utilização no login

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Exemplo didático de autenticação
    $emailCorreto = 'admin@email.com';
    $senhaCorreta = 'Admin@123';

    if (
        $email === $emailCorreto &&
        $senha === $senhaCorreta
    ) {

        registrarAuditoria($pdo, $email, true);

        echo "Login realizado com sucesso!";

    } else {

        registrarAuditoria($pdo, $email, false);

        echo "E-mail ou senha incorretos!";
    }
}

?>

<form method="POST">

    <h2>Login</h2>

    <label>E-mail:</label>
    <input type="email" name="email" required>

    <br><br>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <br><br>

    <button type="submit">Entrar</button>

</form>
