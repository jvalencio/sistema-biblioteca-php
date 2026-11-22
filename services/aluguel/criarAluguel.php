<?php

require_once __DIR__ . "/../../models/Aluguel.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$clientes = $bd->listar("clientes");
$livros = $bd->listar("livros");

$erro = "";
$mensagem = "";
$clienteId = "";
$livroId = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clienteId = $_POST["clienteId"] ?? "";
    $livroId = $_POST["livroId"] ?? "";

    try {
        $aluguel = new Aluguel($bd, (int) $clienteId, (int) $livroId);
        $bd->inserir("alugueis", $aluguel->toArray());

        $mensagem = "Aluguel cadastrado com sucesso!";
        $clienteId = "";
        $livroId = "";
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
    <title>Cadastrar aluguel</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a class="ativo" href="criarAluguel.php">Cadastrar aluguel</a>
            <a href="listarAlugueis.php">Listar aluguéis</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Cadastrar aluguel</h1>
        <p class="subtitulo">Escolha o cliente e o livro para registrar o aluguel.</p>

        <div class="caixa">
            <?php if ($erro): ?>
                <p class="alerta erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>

            <?php if ($mensagem): ?>
                <p class="alerta sucesso"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>

            <?php if (empty($clientes) || empty($livros)): ?>
                <p class="vazio">Cadastre pelo menos um cliente e um livro antes de registrar um aluguel.</p>
            <?php else: ?>
                <form class="formulario" method="POST">
                    <div class="campo">
                        <label for="clienteId">Cliente</label>
                        <select id="clienteId" name="clienteId" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente["id"] ?>" <?= (string) $cliente["id"] === $clienteId ? "selected" : "" ?>>
                                    <?= htmlspecialchars($cliente["nome"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="livroId">Livro</label>
                        <select id="livroId" name="livroId" required>
                            <option value="">Selecione um livro</option>
                            <?php foreach ($livros as $livro): ?>
                                <option value="<?= $livro["id"] ?>" <?= (string) $livro["id"] === $livroId ? "selected" : "" ?>>
                                    <?= htmlspecialchars($livro["titulo"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="botao" type="submit">Cadastrar aluguel</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
