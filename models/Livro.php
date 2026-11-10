<?php

class Livro {
    private int $id;
    private string $titulo;
    private string $autor;
    private int $anoPublicacao;

    public function __construct(string $titulo, string $autor, int $anoPublicacao) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $anoPublicacao;
    }

    // Getters

    public function getId(): int {
        return $this->id;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getAutor(): string {
        return $this->autor;
    }

    public function getAnoPublicacao(): int {
        return $this->anoPublicacao;
    }

    // Setters

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function setAutor(string $autor): void {
        $this->autor = $autor;
    }

    public function setAnoPublicacao(int $anoPublicacao): void {
        $this->anoPublicacao = $anoPublicacao;
    }
}
