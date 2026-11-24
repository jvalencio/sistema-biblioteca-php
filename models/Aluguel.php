<?php

require_once "JsonFile.php";

class Aluguel {
    private int $clienteId;
    private int $livroId;
    private string $data;

    public function __construct (JsonFile $arquivo, int $clienteId, int $livroId) {
        $this->clienteId = $this->validarClienteId($arquivo, $clienteId);
        $this->livroId = $this->validarLivroId($arquivo, $livroId);
        $this->data = date("Y-m-d");
    }

    // Validações

    private function validarClienteId(JsonFile $arquivo, int $clienteId): int {
        $cliente = $arquivo->buscar("clientes", $clienteId);

        if (!$cliente) {
            throw new InvalidArgumentException("Cliente com ID {$clienteId} não foi encontrado.");
        }

        return $cliente["id"];
    }

    private function validarLivroId(JsonFile $arquivo, int $livroId): int {
        $livro = $arquivo->buscar("livros", $livroId);

        if (!$livro) {
            throw new InvalidArgumentException("Livro com ID {$livroId} não foi encontrado.");
        }

        return $livro["id"];
    }

    // Getters

    public function getClienteId(): int {
        return $this->clienteId;
    }

    public function getLivroId(): int {
        return $this->livroId;
    }

    public function getData(): string {
        return $this->data;
    }

    public function toArray(): array {
        return [
            "clienteId" => $this->clienteId,
            "livroId" => $this->livroId,
            "data" => $this->data
        ];
    }
}
