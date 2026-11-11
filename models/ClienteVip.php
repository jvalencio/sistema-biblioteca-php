<?php

require_once "Cliente.php";

class ClienteVip extends Cliente {
    protected string $tipo = "vip";
    private const DESCONTO = 2.00;

    public function calcularValor(): float {
        return parent::calcularValor() - self::DESCONTO;
    }
}
