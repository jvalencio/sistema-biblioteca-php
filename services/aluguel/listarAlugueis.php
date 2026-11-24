<?php

require_once __DIR__ . "/../../models/Cliente.php";
require_once __DIR__ . "/../../models/ClienteVip.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$linhas = [];

foreach ($bd->listar("alugueis") as $aluguel) {
    $dadosCliente = $bd->buscar("clientes", $aluguel["clienteId"]);
    $livro = $bd->buscar("livros", $aluguel["livroId"]);
    $valor = "-";

    if ($dadosCliente) {
        if ($dadosCliente["tipo"] === "vip") {
            $cliente = new ClienteVip($dadosCliente["nome"], $dadosCliente["email"]);
        } else {
            $cliente = new Cliente($dadosCliente["nome"], $dadosCliente["email"]);
        }

        $valor = "R$ " . number_format($cliente->calcularValor(), 2, ",", ".");
    }

    $linhas[] = [
        "cliente" => $dadosCliente["nome"] ?? "Cliente não encontrado",
        "livro" => $livro["titulo"] ?? "Livro não encontrado",
        "data" => date("d/m/Y", strtotime($aluguel["data"])),
        "valor" => $valor
    ];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguéis</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a href="criarAluguel.php">Cadastrar aluguel</a>
            <a class="ativo" href="listarAlugueis.php">Listar aluguéis</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Aluguéis</h1>
        <p class="subtitulo">Todos os aluguéis registrados.</p>

        <div class="caixa">
            <?php if (empty($linhas)): ?>
                <p class="vazio">Nenhum aluguel registrado ainda.</p>
            <?php else: ?>
                <div class="tabela-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Livro</th>
                                <th>Data</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($linhas as $linha): ?>
                                <tr>
                                    <td><?= htmlspecialchars($linha["cliente"]) ?></td>
                                    <td><?= htmlspecialchars($linha["livro"]) ?></td>
                                    <td><?= $linha["data"] ?></td>
                                    <td><?= $linha["valor"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
