<?php
require 'config.php'; // Arquivo de configuração para conexão com o banco de dados

// Consulta para obter todos os alunos
$sql_alunos = "SELECT * FROM alunos";
$stmt_alunos = $pdo->prepare($sql_alunos);
$stmt_alunos->execute();
$alunos = $stmt_alunos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter todos os professores
$sql_professores = "SELECT * FROM professores";
$stmt_professores = $pdo->prepare($sql_professores);
$stmt_professores->execute();
$professores = $stmt_professores->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter todas as aulas
$sql_aulas = "SELECT * FROM aulas";
$stmt_aulas = $pdo->prepare($sql_aulas);
$stmt_aulas->execute();
$aulas = $stmt_aulas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Alunos, Professores e Aulas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Lista de Alunos, Professores e Aulas</h2>

```
    <!-- Lista de Alunos -->
    <div class="mb-3">
        <h4>Alunos</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($alunos) > 0): ?>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?php echo $aluno['id']; ?></td>
                            <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                            <td><?php echo htmlspecialchars($aluno['data_nascimento']); ?></td>
                            <td><?php echo htmlspecialchars($aluno['email']); ?></td>
                            <td>
                                <a href="editar_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir este aluno?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum aluno cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Lista de Professores -->
    <div class="mb-3">
        <h4>Professores</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($professores) > 0): ?>
                    <?php foreach ($professores as $professor): ?>
                        <tr>
                            <td><?php echo $professor['id']; ?></td>
                            <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                            <td><?php echo htmlspecialchars($professor['especialidade']); ?></td>
                            <td><?php echo htmlspecialchars($professor['email']); ?></td>
                            <td>
                                <a href="editar_professor.php?id=<?php echo $professor['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_professor.php?id=<?php echo $professor['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir este professor?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum professor cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Lista de Aulas -->
    <div class="mb-3">
        <h4>Aulas</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Aula</th>
                    <th>Professor</th>
                    <th>Horário de Início</th>
                    <th>Horário de Fim</th>
                    <th>Alunos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($aulas) > 0): ?>
                    <?php foreach ($aulas as $aula): ?>
                        <tr>
                            <td><?php echo $aula['id']; ?></td>
                            <td><?php echo htmlspecialchars($aula['nome_aula']); ?></td>
                            <td>
                                <?php
                                // Exibe o nome do professor da aula
                                $professor_id = $aula['professor_id'];
                                $sql_professor = "SELECT nome FROM professores WHERE id = :id";
                                $stmt_professor = $pdo->prepare($sql_professor);
                                $stmt_professor->bindParam(':id', $professor_id);
                                $stmt_professor->execute();
                                $professor = $stmt_professor->fetch(PDO::FETCH_ASSOC);
                                echo htmlspecialchars($professor['nome']);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($aula['horario_inicio']); ?></td>
                            <td><?php echo htmlspecialchars($aula['horario_fim']); ?></td>
                            <td>
                                <?php
                                // Exibe a lista de alunos na aula
                                $aula_id = $aula['id'];
                                $sql_alunos_aula = "SELECT alunos.nome FROM alunos
                                                    JOIN alunos_aulas ON alunos.id = alunos_aulas.aluno_id
                                                    WHERE alunos_aulas.aula_id = :aula_id";
                                $stmt_alunos_aula = $pdo->prepare($sql_alunos_aula);
                                $stmt_alunos_aula->bindParam(':aula_id', $aula_id);
                                $stmt_alunos_aula->execute();
                                $alunos_aula = $stmt_alunos_aula->fetchAll(PDO::FETCH_ASSOC);
                                echo count($alunos_aula) . " aluno(s)";
                                ?>
                                <ul>
                                    <?php foreach ($alunos_aula as $aluno_aula): ?>
                                        <li><?php echo htmlspecialchars($aluno_aula['nome']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <a href="editar_aula.php?id=<?php echo $aula['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_aula.php?id=<?php echo $aula['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir esta aula?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhuma aula cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

```

</body>
</html>