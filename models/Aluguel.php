<?php

class Aluguel {
    private int $id;
    private int $clienteId;
    private int $livroId;
    private string $dataAluguel;

    public function __construct (int $id, int $clienteId, int $livroId, string $dataAluguel) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->livroId = $livroId;
        $this->dataAluguel = $dataAluguel;
    }

    // Getters

    public function getId(): int {
        return $this->id;
    }

    public function getClienteId(): int {
        return $this->clienteId;
    }

    public function getLivroId(): int {
        return $this->livroId;
    }
    
    public function getDataAluguel(): string {
        return $this->dataAluguel;
    }

    // Setters

    public function setClienteId(int $clienteId): void {
        $this->clienteId = $clienteId;
    }
    
    public function setLivroId(int $livroId): void {
        $this->livroId = $livroId;
    }

    public function setDataAluguel(string $dataAluguel): void {
        $this->dataAluguel = $dataAluguel;
    }
}
