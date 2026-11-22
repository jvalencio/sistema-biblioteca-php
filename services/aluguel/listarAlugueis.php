<?php

require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$alugueis = $bd->listar("alugueis");

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
            <?php if (empty($alugueis)): ?>
                <p class="vazio">Nenhum aluguel registrado ainda.</p>
            <?php else: ?>
                <div class="tabela-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Livro</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alugueis as $aluguel): ?>
                                <?php
                                $cliente = $bd->buscar("clientes", $aluguel["clienteId"]);
                                $livro = $bd->buscar("livros", $aluguel["livroId"]);
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente["nome"] ?? "Cliente não encontrado") ?></td>
                                    <td><?= htmlspecialchars($livro["titulo"] ?? "Livro não encontrado") ?></td>
                                    <td><?= date("d/m/Y", strtotime($aluguel["data"])) ?></td>
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
