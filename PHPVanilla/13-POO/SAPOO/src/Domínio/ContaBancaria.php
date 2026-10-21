<?php
declare(strict_types=1);

//Super Classe Abstrata de Conta Bancaria => Não permite Instanciamento

abstract class ContaBancaria {
    //atributo
    protected float $saldo;

    //construtor da classe usando property promotion (Declaro os atributos dentro do construtor)
    public function __construct(
        public readonly string $agencia,//atributo que recebera a agencia
        public readonly string $numeroConta,//atributo que recebera o nº da conta
        public readonly Titular $titular,//atributo que recebera os dados do titular (Classe Titular)
        float $saldoInicial = 0.0
    ) {
        if($saldoInicial < 0.0) {//lança uma excception caso valor do saldo inicial seja negativo
            throw new ValorInvalidoException($saldoInicial);
        }
        $this->saldo = $saldoInicial;
    }

    //metodo para depositar na comnta (adicionar ao saldo) RN 
    public function depositar(float $valor):void {
        if($valor <=0.0){ //se valor negativo lança uma exception
            throw new ValorInvalidoException($valor);
        }
        //se tudo der certo
        //$this->saldo = $this->saldo + $valor;
        $this->saldo += $valor;
    }

    
}