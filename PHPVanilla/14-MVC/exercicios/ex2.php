<?php 
declare(strict_types=1);

final class Controller{
    public function  renderizarJson(): void {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    }
}