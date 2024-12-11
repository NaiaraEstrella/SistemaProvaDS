<?php
require 'config.php';

if (isset($_GET['id'])) {
// Exclusão individual
$id = intval($_GET['id']);
$sql = "DELETE FROM professores WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
header('Location: listar_professores.php');
exit;
} elseif (isset($_POST['excluir'])) {
// Exclusão múltipla
if (!empty($_POST['professores'])) {
$ids = implode(',', $_POST['professores']);
$sql = "DELETE FROM professores WHERE id IN ($ids)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
header('Location: listar_professores.php');
exit;
} else {
$erro = "Nenhum professor foi selecionado para exclusão.";
}
}

$erro = ''; // Mensagem de erro
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Professores</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Excluir Professor(es)</h2>

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
                // Exibe os professores
                $sql = "SELECT * FROM professores";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $professores = $stmt->fetchAll();
                foreach ($professores as $professor) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='professores[]' value='" . $professor['id'] . "'></td>";
                    echo "<td>" . $professor['id'] . "</td>";
                    echo "<td>" . $professor['nome'] . "</td>";
                    echo "<td><a href='excluir_professor.php?id=" . $professor['id'] . "' class='btn btn-danger'>Excluir</a></td>";
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