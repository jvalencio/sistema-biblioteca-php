<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="topo">
        <a class="marca" href="index.php">Biblioteca</a>
    </header>

    <main class="conteudo">
        <h1>Sistema de Biblioteca</h1>
        <p class="subtitulo">Escolha uma área para começar.</p>

        <div class="secoes">
            <section class="secao">
                <h2>Clientes</h2>
                <p>Cadastre e consulte os clientes da biblioteca.</p>
                <div class="acoes">
                    <a class="botao" href="services/cliente/criarCliente.php">Cadastrar</a>
                    <a class="botao botao-secundario" href="services/cliente/listarClientes.php">Listar</a>
                </div>
            </section>

            <section class="secao">
                <h2>Livros</h2>
                <p>Cadastre e consulte os livros do acervo.</p>
                <div class="acoes">
                    <a class="botao" href="services/livro/criarLivro.php">Cadastrar</a>
                    <a class="botao botao-secundario" href="services/livro/listarLivros.php">Listar</a>
                </div>
            </section>

            <section class="secao">
                <h2>Aluguéis</h2>
                <p>Registre e consulte os aluguéis de livros.</p>
                <div class="acoes">
                    <a class="botao" href="services/aluguel/criarAluguel.php">Cadastrar</a>
                    <a class="botao botao-secundario" href="services/aluguel/listarAlugueis.php">Listar</a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
