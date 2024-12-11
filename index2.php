<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página Inicial - Sistema de Gestão</title>
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
.sidenav .sub-menu {
padding-left: 20px;
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

    <!-- Listar -->
    <div>
        <a href="#">Listar</a>
        <div class="sub-menu">
            <a href="listar_alunos.php">Lista de Alunos</a>
            <a href="listar_professores.php">Lista de Professores</a>
            <a href="listar_aulas.php">Lista de Aulas</a>
            <a href="listar_informacoes_relacionadas.php">Listar Informações Relacionadas</a>
        </div>
    </div>

    <!-- Cadastrar -->
    <div>
        <a href="#">Cadastrar</a>
        <div class="sub-menu">
            <a href="cadastro_aluno.php">Cadastro de Alunos</a>
            <a href="cadastro_professor.php">Cadastro de Professores</a>
            <a href="cadastro_aula.php">Cadastro de Aulas</a>
        </div>
    </div>

    <!-- Editar -->
    <div>
        <a href="#">Editar</a>
        <div class="sub-menu">
            <a href="editar_aluno.php">Edição de Alunos</a>
            <a href="editar_professor.php">Edição de Professores</a>
            <a href="editar_aula.php">Edição de Aulas</a>
        </div>
    </div>

    <!-- Excluir -->
    <div>
        <a href="#">Excluir</a>
        <div class="sub-menu">
            <a href="excluir_aluno.php">Exclusão de Alunos</a>
            <a href="excluir_professor.php">Exclusão de Professores</a>
            <a href="excluir_aula.php">Exclusão de Aulas</a>
        </div>
    </div>
</div>

<!-- Conteúdo Principal -->
<div class="main-content">
    <h1 class="text-center">Bem-vindo ao Sistema de Gestão</h1>

    <!-- Informações principais ou conteúdo -->
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