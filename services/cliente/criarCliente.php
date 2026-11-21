<?php

require_once __DIR__ . "/../../models/Cliente.php";
require_once __DIR__ . "/../../models/ClienteVip.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$erro = "";
$mensagem = "";
$nome = "";
$email = "";
$tipo = "comum";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $tipo = $_POST["tipo"] ?? "comum";

    try {
        if ($tipo === "vip") {
            $cliente = new ClienteVip($nome, $email);
        } else {
            $cliente = new Cliente($nome, $email);
        }

        $bd = new JsonFile();
        $bd->inserir("clientes", $cliente->toArray());

        $mensagem = "Cliente cadastrado com sucesso!";
        $nome = "";
        $email = "";
        $tipo = "comum";
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
    <title>Cadastrar cliente</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a class="ativo" href="criarCliente.php">Cadastrar cliente</a>
            <a href="listarClientes.php">Listar clientes</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Cadastrar cliente</h1>
        <p class="subtitulo">Preencha os dados para criar um novo cliente.</p>

        <div class="caixa">
            <?php if ($erro): ?>
                <p class="alerta erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>

            <?php if ($mensagem): ?>
                <p class="alerta sucesso"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>

            <form class="formulario" method="POST">
                <div class="campo">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" required>
                </div>

                <div class="campo">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>

                <div class="campo">
                    <label for="tipo">Tipo de cliente</label>
                    <select id="tipo" name="tipo">
                        <option value="comum" <?= $tipo === "comum" ? "selected" : "" ?>>Comum</option>
                        <option value="vip" <?= $tipo === "vip" ? "selected" : "" ?>>VIP</option>
                    </select>
                </div>

                <button class="botao" type="submit">Cadastrar cliente</button>
            </form>
        </div>
    </main>
</body>
</html>
