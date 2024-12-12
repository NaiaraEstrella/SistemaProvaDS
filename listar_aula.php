<?php
require 'config.php';

// Consulta para buscar todas as aulas
$sql = "SELECT * FROM aulas";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$aulas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Aulas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Título centralizado -->
    <h2 class="text-center">Lista de Aulas</h2>
    
    <!-- Tabela para listar as aulas -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome da Aula</th>
                <th>Professor</th>
                <th>Quantidade Máxima</th>
                <th>Horário de Início</th>
                <th>Horário Final</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aulas as $aula): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aula['id']); ?></td>
                    <td><?php echo htmlspecialchars($aula['nome_aula']); ?></td>
                    <td><?php echo htmlspecialchars($aula['professor']); ?></td>
                    <td><?php echo htmlspecialchars($aula['quantidade_maxima']); ?></td>
                    <td><?php echo htmlspecialchars($aula['hora_inicio']); ?></td>
                    <td><?php echo htmlspecialchars($aula['hora_fim']); ?></td>
                    <td>
                        <!-- Link para editar a aula com o id como parâmetro na URL -->
                        <a href="editar_aula.php?id=<?php echo $aula['id']; ?>" class="btn btn-primary">Editar</a>
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
