<?php

class Cliente {
    private ?int $id = null;
    private string $nome;
    private string $email;
    protected string $tipo = "comum";
    protected const VALOR_ALUGUEL = 6.00;

    public function __construct (string $nome, string $email) {
        $this->nome = $this->validarNome($nome);
        $this->email = $this->validarEmail($email);
    }

    // Validações

    private function validarNome(string $nome): string {
        $nome = trim($nome);

        if ($nome === "") {
            throw new InvalidArgumentException("O nome não pode ficar vazio.");
        }

        if (mb_strlen($nome) > 100) {
            throw new InvalidArgumentException("O nome deve ter no máximo 100 caracteres.");
        }

        return $nome;
    }

    private function validarEmail(string $email) {
        $email = trim($email);

        if ($email === "") {
            throw new InvalidArgumentException("O e-mail não pode ficar vazio.");
        }

        if (!str_contains($email, "@") || !str_ends_with($email, ".com")) {
            throw new InvalidArgumentException("O e-mail precisa estar em um formato válido.");
        }

        return $email;
    }

    // Getters

    public function getNome(): string {
        return $this->nome;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "email" => $this->email,
            "tipo" => $this->tipo
        ];
    }

    // Funções

    public function calcularValor(): float {
        return static::VALOR_ALUGUEL;
    }
}
