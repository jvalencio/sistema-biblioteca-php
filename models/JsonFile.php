<?php

class JsonFile {
    private string $arquivo;

    public function __construct(?string $arquivo = null) {
        $this->arquivo = $arquivo ?? __DIR__ . "/../bd.json";

        if (!file_exists($this->arquivo)) {
            $this->gravar([
                "livros" => [],
                "clientes" => [],
                "alugueis" => [],
            ]);
        }
    }

    public function listar(string $tabela): array {
        $dados = $this->ler();
        return $this->tabela($dados, $tabela);
    }

    public function buscar(string $tabela, int $id): ?array {
        foreach ($this->listar($tabela) as $registro) {
            if ((int) ($registro["id"] ?? 0) === $id) {
                return $registro;
            }
        }

        return null;
    }

    public function inserir(string $tabela, array $registro): int {
        $dados = $this->ler();
        $lista = $this->tabela($dados, $tabela);

        $maior = 0;
        foreach ($lista as $r) {
            $maior = max($maior, (int) ($r["id"] ?? 0));
        }
        $novoId = $maior + 1;

        $registro["id"] = $novoId;

        $lista[] = $registro;
        $dados[$tabela] = $lista;
        $this->gravar($dados);

        return $novoId;
    }

    public function atualizar(string $tabela, int $id, array $registro): bool {
        $dados = $this->ler();
        $lista = $this->tabela($dados, $tabela);

        foreach ($lista as $i => $r) {
            if ((int) ($r["id"] ?? 0) === $id) {
                $registro["id"] = $id;
                $lista[$i] = $registro;
                $dados[$tabela] = $lista;
                $this->gravar($dados);

                return true;
            }
        }
        return false;
    }

    public function excluir(string $tabela, int $id): bool {
        $dados = $this->ler();
        $lista = $this->tabela($dados, $tabela);

        foreach ($lista as $i => $r) {
            if ((int) ($r["id"] ?? 0) === $id) {
                unset($lista[$i]);
                $dados[$tabela] = array_values($lista);
                $this->gravar($dados);

                return true;
            }
        }

        return false;
    }

    private function ler(): array {
        $conteudo = file_get_contents($this->arquivo);

        if ($conteudo === false) {
            throw new RuntimeException("Não foi possível ler o arquivo bd.json.");
        }
        if (trim($conteudo) === "") {
            return [];
        }

        $dados = json_decode($conteudo, true);

        if (!is_array($dados)) {
            throw new RuntimeException("O bd.json está com o JSON inválido: " . json_last_error_msg());
        }

        return $dados;
    }

    private function tabela(array $dados, string $tabela): array {
        $lista = $dados[$tabela] ?? [];
        return is_array($lista) ? array_values($lista) : [];
    }

    private function gravar(array $dados): void {
        $json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($json === false) {
            throw new RuntimeException("Não foi possível converter os dados para JSON.");
        }

        if (file_put_contents($this->arquivo, $json, LOCK_EX) === false) {
            throw new RuntimeException("Não foi possivel gravar o bd.json (verifique as permissões da pasta).");
        }
    }
}
