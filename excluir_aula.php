<?php
require 'config.php';

if (isset($_GET['id'])) {
// Exclusão individual
$id = intval($_GET['id']);
$sql = "DELETE FROM aulas WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
header('Location: listar_aulas.php');
exit;
} elseif (isset($_POST['excluir'])) {
// Exclusão múltipla
if (!empty($_POST['aulas'])) {
$ids = implode(',', $_POST['aulas']);
$sql = "DELETE FROM aulas WHERE id IN ($ids)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
header('Location: listar_aulas.php');
exit;
} else {
$erro = "Nenhuma aula foi selecionada para exclusão.";
}
}

$erro = ''; // Mensagem de erro
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Aulas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Excluir Aula(s)</h2>

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
                    <th>Nome da Aula</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibe as aulas
                $sql = "SELECT * FROM aulas";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $aulas = $stmt->fetchAll();
                foreach ($aulas as $aula) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='aulas[]' value='" . $aula['id'] . "'></td>";
                    echo "<td>" . $aula['id'] . "</td>";
                    echo "<td>" . $aula['nome_aula'] . "</td>";
                    echo "<td><a href='excluir_aula.php?id=" . $aula['id'] . "' class='btn btn-danger'>Excluir</a></td>";
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