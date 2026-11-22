<?php

require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$livros = $bd->listar("livros");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a href="criarLivro.php">Cadastrar livro</a>
            <a class="ativo" href="listarLivros.php">Listar livros</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Livros</h1>
        <p class="subtitulo">Todos os livros cadastrados.</p>

        <div class="caixa">
            <?php if (empty($livros)): ?>
                <p class="vazio">Nenhum livro cadastrado ainda.</p>
            <?php else: ?>
                <div class="tabela-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Ano</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($livros as $livro): ?>
                                <tr>
                                    <td><?= htmlspecialchars($livro["titulo"]) ?></td>
                                    <td><?= htmlspecialchars($livro["autor"]) ?></td>
                                    <td><?= htmlspecialchars($livro["anoPublicacao"]) ?></td>
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
