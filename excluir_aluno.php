<?php
require 'config.php';

if (isset($_GET['id'])) {
// Exclusão individual
$id = intval($_GET['id']);
$sql = "DELETE FROM alunos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
header('Location: listar_alunos.php');
exit;
} elseif (isset($_POST['excluir'])) {
// Exclusão múltipla
if (!empty($_POST['alunos'])) {
$ids = implode(',', $_POST['alunos']);
$sql = "DELETE FROM alunos WHERE id IN ($ids)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
header('Location: listar_alunos.php');
exit;
} else {
$erro = "Nenhum aluno foi selecionado para exclusão.";
}
}

$erro = ''; // Mensagem de erro
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Alunos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Excluir Aluno(s)</h2>

```
    <?php if (isset($erro) && $erro): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check_all"></th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibe os alunos
                $sql = "SELECT * FROM alunos";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $alunos = $stmt->fetchAll();
                foreach ($alunos as $aluno) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='alunos[]' value='" . $aluno['id'] . "'></td>";
                    echo "<td>" . $aluno['id'] . "</td>";
                    echo "<td>" . $aluno['nome'] . "</td>";
                    echo "<td><a href='excluir_aluno.php?id=" . $aluno['id'] . "' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="submit" name="excluir" class="btn btn-danger">Excluir Selecionados</button>
    </form>

    <script>
        // Selecionar/deselecionar todos os checkboxes
        document.getElementById('check_all').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</div>

```

</body>
</html>