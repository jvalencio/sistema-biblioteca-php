<?php

require_once __DIR__ . "/../../models/JsonFile.php";

$bd = new JsonFile();
$clientes = $bd->listar("clientes");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="../../index.php">Biblioteca</a>
        <nav class="menu">
            <a href="../../index.php">Início</a>
            <a href="criarCliente.php">Cadastrar cliente</a>
            <a class="ativo" href="listarClientes.php">Listar clientes</a>
        </nav>
    </header>

    <main class="conteudo">
        <h1>Clientes</h1>
        <p class="subtitulo">Todos os clientes cadastrados.</p>

        <div class="caixa">
            <?php if (empty($clientes)): ?>
                <p class="vazio">Nenhum cliente cadastrado ainda.</p>
            <?php else: ?>
                <div class="tabela-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <?php $tipo = $cliente["tipo"] === "vip" ? "VIP" : "Comum"; ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                                    <td><?= htmlspecialchars($cliente["email"]) ?></td>
                                    <td><?= $tipo ?></td>
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
