<?php
declare(strict_types=1);

use DomainException;//bibliot4ecA DE ERROS DO PHP

class ContaException extends DomainException {
    //Herdando as Exception da Biblioteca DomainException
    #[Override]
    public function __construct(string $message = "Falha na operação bancária")
    {
        return parent::__construct($message);
    }
}