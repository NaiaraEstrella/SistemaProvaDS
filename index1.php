<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página Inicial - Academia</title>
<!-- Link do Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
/* Estilo para o menu lateral */
.sidenav {
height: 100%;
width: 250px;
position: fixed;
top: 0;
left: 0;
background-color: #111;
padding-top: 20px;
}
.sidenav a {
padding: 10px 15px;
text-decoration: none;
font-size: 18px;
color: white;
display: block;
}
.sidenav a:hover {
background-color: #575757;
}
.main-content {
margin-left: 270px; /* Espaço para o menu lateral */
padding: 20px;
}
.logo-img {
width: 100%;
height: auto;
}
</style>
</head>
<body>

```
<!-- Menu Lateral -->
<div class="sidenav">
    <h2 class="text-white text-center">Menu</h2>
    <a href="listar.php">Lista de Alunos, Professores e Aulas</a>
    <a href="cadastro.php">Efetuar Cadastro</a>
    <a href="editar.php">Editar Cadastro</a>
    <a href="marcar.php">Marcar Consulta</a>
    <a href="visualizar_consultas.php">Consultas Agendadas</a>
</div>

<!-- Conteúdo Principal -->
<div class="main-content">
    <!-- Nome da Academia -->
    <h1 class="text-center" id="academia-name">Nome da Academia Aqui</h1>
    <!-- Comentário: Substitua "Nome da Academia Aqui" pelo nome da sua academia -->

    <!-- Frase Motivadora -->
    <p class="text-center" id="motivational-quote">"Sua jornada para a saúde começa aqui!"</p>
    <!-- Comentário: Substitua "Sua jornada para a saúde começa aqui!" por uma frase motivadora -->

    <!-- Foto da Academia -->
    <div class="text-center">
        <img src="caminho/para/sua/foto.jpg" alt="Foto da Academia" class="logo-img">
        <!-- Comentário: Substitua "caminho/para/sua/foto.jpg" pelo caminho correto da foto da academia -->
    </div>

    <!-- Botões de Ação -->
    <div class="text-center mt-4">
        <a href="cadastro.php" class="btn btn-primary btn-lg m-2">Efetuar Cadastro</a>
        <a href="editar.php" class="btn btn-warning btn-lg m-2">Editar Cadastro</a>
        <a href="marcar.php" class="btn btn-success btn-lg m-2">Marcar Consulta</a>
        <a href="visualizar_consultas.php" class="btn btn-primary btn-lg m-2">Consultas Agendadas</a>
    </div>
</div>

<!-- Link do Bootstrap JS e dependências -->
<script src="<https://code.jquery.com/jquery-3.5.1.slim.min.js>"></script>
<script src="<https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js>"></script>
<script src="<https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js>"></script>

```

</body>
</html>