<?php
declare(strict_types=1);

require_once 'config/conexao.php';
require_once 'models/Usuario.php';
require_once 'DAO/UsuarioDAO.php';

//preg_match ferifica se um texto corresponde a um padraõ especifico.

// Função para validar a complexidade da senha
function validarSenha(string $senha): bool
{
    if (strlen($senha) < 8) {
        return false;
    }

    // Pelo menos uma letra maiúscula
    if (!preg_match('/[A-Z]/', $senha)) {
        return false;
    }

    // Pelo menos uma letra minúscula
    if (!preg_match('/[a-z]/', $senha)) {
        return false;
    }

    // Pelo menos um número
    if (!preg_match('/[0-9]/', $senha)) {
        return false;
    }

    // Pelo menos um caractere especial
    if (!preg_match('/[^a-zA-Z0-9]/', $senha)) {
        return false;
    }

    return true;
}

// Cadastro interativo
echo "===== CADASTRO DE COLABORADOR =====\n";

echo "Nome: ";
$nome = trim(fgets(STDIN));

echo "E-mail: ";
$email = trim(fgets(STDIN));

// Solicita a senha
echo "Senha: ";
$senha = trim(fgets(STDIN));
$mensagem = [];

// Validar a senha
if (!validarSenha($senha)) {
   $mensagem = "erro: senha invalida";

    exit(1);
}

// Gera o hash seguro
$hash = password_hash($senha, PASSWORD_ARGON2ID);

if ($hash === false) {
   $mensagem = "Erro ao gerar o hash da senha.";
}

// Cria o objeto usuário
$usuario = new Usuario();
$usuario->setNome($nome);
$usuario->setEmail($email);
$usuario->setSenha($hash);

// Persiste no banco utilizando UsuarioDAO
$dao = new UsuarioDAO($pdo);

if ($dao->cadastrar($usuario)) {
    $mensagem =  "Colaborador cadastrado com sucesso!";
} else {
    $mensagem =  "Erro ao cadastrar colaborador.";
}

