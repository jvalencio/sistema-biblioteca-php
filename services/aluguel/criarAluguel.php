<?php

require_once __DIR__ . "/../../models/Cliente.php";
require_once __DIR__ . "/../../models/ClienteVip.php";
require_once __DIR__ . "/../../models/Aluguel.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$clientes = $bd->listar("clientes");
$livros = $bd->listar("livros");

$erro = "";
$mensagem = "";
$clienteId = $clientes[0]["id"] ?? 0;
$livroId = $livros[0]["id"] ?? 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clienteId = (int) ($_POST["clienteId"] ?? 0);
    $livroId = (int) ($_POST["livroId"] ?? 0);

    if (isset($_POST["cadastrar"])) {
        try {
            $aluguel = new Aluguel($bd, $clienteId, $livroId);
            $bd->inserir("alugueis", $aluguel->toArray());

            $mensagem = "Aluguel cadastrado com sucesso!";
        } catch (InvalidArgumentException $e) {
            $erro = $e->getMessage();
        }
    }
}

$valor = "";
$dadosCliente = $bd->buscar("clientes", $clienteId);

if ($dadosCliente) {
    if ($dadosCliente["tipo"] === "vip") {
        $clienteSelecionado = new ClienteVip($dadosCliente["nome"], $dadosCliente["email"]);
    } else {
        $clienteSelecionado = new Cliente($dadosCliente["nome"], $dadosCliente["email"]);
    }

    $valor = "R$ " . number_format($clienteSelecionado->calcularValor(), 2, ",", ".");
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
        <p class="subtitulo">Escolha o cliente e o livro. Use "Ver valor" para atualizar o valor do cliente escolhido.</p>

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
                        <select id="clienteId" name="clienteId">
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente["id"] ?>" <?= $cliente["id"] === $clienteId ? "selected" : "" ?>>
                                    <?= htmlspecialchars($cliente["nome"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="livroId">Livro</label>
                        <select id="livroId" name="livroId">
                            <?php foreach ($livros as $livro): ?>
                                <option value="<?= $livro["id"] ?>" <?= $livro["id"] === $livroId ? "selected" : "" ?>>
                                    <?= htmlspecialchars($livro["titulo"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="valor">Valor do aluguel</label>
                        <input type="text" id="valor" value="<?= $valor ?>" readonly>
                    </div>

                    <div class="acoes">
                        <button class="botao botao-secundario" type="submit">Ver valor</button>
                        <button class="botao" type="submit" name="cadastrar">Cadastrar aluguel</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
