<?php
require 'config.php'; // Arquivo de configuração para conexão com o banco de dados

// Verifica se o ID da aula foi passado na URL
if (isset($_GET['id'])) {
$aula_id = intval($_GET['id']);


// Consulta para obter os detalhes da aula
$sql_aula = "SELECT * FROM aulas WHERE id = :id";
$stmt_aula = $pdo->prepare($sql_aula);
$stmt_aula->bindParam(':id', $aula_id);
$stmt_aula->execute();
$aula = $stmt_aula->fetch(PDO::FETCH_ASSOC);

if (!$aula) {
    echo "A aula não foi encontrada.";
    exit;
}

// Consulta para obter o professor da aula
$professor_id = $aula['professor_id'];
$sql_professor = "SELECT nome FROM professores WHERE id = :id";
$stmt_professor = $pdo->prepare($sql_professor);
$stmt_professor->bindParam(':id', $professor_id);
$stmt_professor->execute();
$professor = $stmt_professor->fetch(PDO::FETCH_ASSOC);

// Consulta para obter os alunos inscritos na aula
$sql_alunos_aula = "SELECT alunos.nome FROM alunos
                    JOIN alunos_aulas ON alunos.id = alunos_aulas.aluno_id
                    WHERE alunos_aulas.aula_id = :aula_id";
$stmt_alunos_aula = $pdo->prepare($sql_alunos_aula);
$stmt_alunos_aula->bindParam(':aula_id', $aula_id);
$stmt_alunos_aula->execute();
$alunos_aula = $stmt_alunos_aula->fetchAll(PDO::FETCH_ASSOC);



} else {
echo "ID da aula não fornecido.";
exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Informações da Aula</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Detalhes da Aula: <?php echo htmlspecialchars($aula['nome_aula']); ?></h2>


    <div class="mb-3">
        <h4>Professor</h4>
        <p>Nome: <?php echo htmlspecialchars($professor['nome']); ?></p>
    </div>

    <div class="mb-3">
        <h4>Alunos Inscritos</h4>
        <ul>
            <?php foreach ($alunos_aula as $aluno_aula): ?>
                <li><?php echo htmlspecialchars($aluno_aula['nome']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="mb-3">
        <h4>Horário</h4>
        <p>Início: <?php echo htmlspecialchars($aula['horario_inicio']); ?></p>
        <p>Fim: <?php echo htmlspecialchars($aula['horario_fim']); ?></p>
    </div>

    <a href="listar.php" class="btn btn-primary">Voltar à lista</a>
</div>


</body>
</html>