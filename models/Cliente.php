<?php

class Cliente {
    private int $id;
    private string $nome;
    private string $email;
    private string $tipo;

    public function __construct (int $id, string $nome, string $email, string $tipo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->tipo = $tipo;
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

    public function setTipo(string $tipo): void {
        $this->tipo = $tipo;
    }
}
