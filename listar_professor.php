<?php
require 'config.php';

// Consulta para buscar todos os professores
$sql = "SELECT * FROM professores";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$professores = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Título centralizado -->
    <h2 class="text-center">Lista de Professores</h2>
    
    <!-- Tabela para listar os professores -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Telefone</th>
                
                <th>Sexo</th>
                <th>Ações</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professores as $professor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($professor['id']); ?></td>
                    <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                    <td><?php echo htmlspecialchars($professor['especialidade']); ?></td>
                    <td><?php echo htmlspecialchars($professor['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($professor['sexo']); ?></td>
                    <td>
                        <!-- Link para editar o professor com o id como parâmetro na URL -->
                        <a href="editar_professor.php?id=<?php echo $professor['id']; ?>" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Botão para voltar ao menu -->
<div class="text-center mt-3">
    <a href="index2.php" class="btn btn-primary btn-lg m-2">Voltar ao menu</a>
</div>

</body>
</html>
