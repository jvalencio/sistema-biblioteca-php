<?php

class Cliente {
    private int $id;
    private string $nome;
    private string $email;
    protected string $tipo = "comum";
    protected const VALOR_ALUGUEL = 6.00;

    public function __construct (int $id, string $nome, string $email) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    // Getters

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    // Setters

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    // Funções

    public function calcularValor(): float {
        return static::VALOR_ALUGUEL;
    }
}
