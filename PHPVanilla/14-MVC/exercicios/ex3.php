<?php 
declare(strict_types=1);

final class armazenar{
    private array $rotas = [];

    public function get(string $uri, ): void{

        $this->rotas['GET'][$uri];
    }
     private function registrarLog(string $metodo, string $uri): void
    {
        $data = date('Y-m-d H:i:s');

        $ip = $_SERVER['REMOTE_ADDR'] ?? 'IP desconhecido';

        $log = "$data | IP: $ip | Método: $metodo | URI: $uri"
             . PHP_EOL;

        // Cria a pasta logs caso ela não exista
        if (!is_dir('logs')) {
            mkdir('logs', 0775, true);
        }

        // Registra o acesso no arquivo
        file_put_contents(
            'logs/acessos.log',
            $log,
            FILE_APPEND | LOCK_EX
        );
    }
}
