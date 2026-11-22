<?php

require_once __DIR__ . "/../../models/Livro.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$erro = "";
$mensagem = "";
$titulo = "";
$autor = "";
$anoPublicacao = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST["titulo"] ?? "";
    $autor = $_POST["autor"] ?? "";
    $anoPublicacao = $_POST["anoPublicacao"] ?? "";

    try {
        $livro = new Livro($titulo, $autor, (int) $anoPublicacao);

        $bd = new JsonFile();
        $bd->inserir("livros", $livro->toArray());

        $mensagem = "Livro cadastrado com sucesso!";
        $titulo = "";
        $autor = "";
        $anoPublicacao = "";
    } catch (InvalidArgumentException $e) {
        $erro = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar livro</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a class="ativo" href="criarLivro.php">Cadastrar livro</a>
            <a href="listarLivros.php">Listar livros</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Cadastrar livro</h1>
        <p class="subtitulo">Preencha os dados para adicionar um livro ao acervo.</p>

        <div class="caixa">
            <?php if ($erro): ?>
                <p class="alerta erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>

            <?php if ($mensagem): ?>
                <p class="alerta sucesso"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>

            <form class="formulario" method="POST">
                <div class="campo">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($titulo) ?>" required>
                </div>

                <div class="campo">
                    <label for="autor">Autor</label>
                    <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($autor) ?>" required>
                </div>

                <div class="campo">
                    <label for="anoPublicacao">Ano de publicação</label>
                    <input type="number" id="anoPublicacao" name="anoPublicacao" value="<?= htmlspecialchars($anoPublicacao) ?>" required>
                </div>

                <button class="botao" type="submit">Cadastrar livro</button>
            </form>
        </div>
    </main>
</body>
</html>
