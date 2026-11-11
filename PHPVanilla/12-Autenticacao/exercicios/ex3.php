
<?php
declare(strict_types=1);

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Função para verificar permissões
function verificarPermissao(string $perfilMinimo): void {

    // Pega o perfil do usuário logado
    $perfilUsuario = $_SESSION['perfil'] ?? '';

    // Define a hierarquia dos perfis
    $niveis = [
        'OPERADOR' => 1,
        'ADMIN' => 2
    ];

    // Verifica se os perfis existem
    if (
        !isset($niveis[$perfilUsuario]) ||
        !isset($niveis[$perfilMinimo])
    ) {
        http_response_code(403);
        echo "Acesso negado!";
        exit;
    }

    // Verifica se o usuário possui nível suficiente
    if ($niveis[$perfilUsuario] < $niveis[$perfilMinimo]) {

        http_response_code(403);

        echo "<h1>403 - Acesso negado!</h1>";
        echo "<p>Você não possui permissão para acessar esta página.</p>";
        echo "<p>Seu perfil atual: " . htmlspecialchars($perfilUsuario) . "</p>";
        echo "<a href='index.php'>Voltar para o início</a>";

        exit;
    }
}

?>
