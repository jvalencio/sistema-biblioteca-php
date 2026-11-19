<?php

require_once __DIR__ . "/../../models/Cliente.php";
require_once __DIR__ . "/../../models/ClienteVip.php";
require_once __DIR__ . "/../../models/JsonFile.php";

$erro = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $tipo = $_POST["tipo"] ?? "";

    try {
        if ($tipo === "vip") {
            $cliente = new ClienteVip($nome, $email);
        } else {
            $cliente = new Cliente($nome, $email);
        }

        $bd = new JsonFile();
        $bd->inserir("clientes", $cliente->toArray());

        $mensagem = "Cliente cadastrado com sucesso!";
    } catch (\InvalidArgumentException $e) {
        $erro = $e->getMessage();
    }
}

?>
