<?php

class Livro {
    private string $titulo;
    private string $autor;
    private int $anoPublicacao;

    public function __construct(string $titulo, string $autor, int $anoPublicacao) {
        $this->titulo = $this->validarTitulo($titulo);
        $this->autor = $this->validarAutor($autor);
        $this->anoPublicacao = $this->validarAnoPublicacao($anoPublicacao);
    }

    // Validações

    private function validarTitulo(string $titulo): string {
        $titulo = trim($titulo);

        if ($titulo === "") {
            throw new InvalidArgumentException("O título não pode ficar vazio.");
        }

        if (mb_strlen($titulo) > 150) {
            throw new InvalidArgumentException("O título deve ter no máximo 150 caracteres.");
        }

        return $titulo;
    }

    private function validarAutor(string $autor): string {
        $autor = trim($autor);

        if ($autor === "") {
            throw new InvalidArgumentException("O autor não pode ficar vazio.");
        }

        if (mb_strlen($autor) > 100) {
            throw new InvalidArgumentException("O autor deve ter no máximo 100 caracteres.");
        }

        return $autor;
    }

    private function validarAnoPublicacao(int $anoPublicacao): int {
        $anoAtual = (int) date("Y");

        if ($anoPublicacao < 1000 || $anoPublicacao > $anoAtual) {
            throw new InvalidArgumentException("O ano de publicação deve estar entre 1000 e {$anoAtual}.");
        }

        return $anoPublicacao;
    }

    // Getters

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getAutor(): string {
        return $this->autor;
    }

    public function getAnoPublicacao(): int {
        return $this->anoPublicacao;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "titulo" => $this->titulo,
            "autor" => $this->autor,
            "anoPublicacao" => $this->anoPublicacao
        ];
    }
}
