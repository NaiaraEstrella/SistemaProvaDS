<?php
require 'config.php';

$erro = ''; // Inicializa a variável de erro
$sucesso = ''; // Inicializa a variável de sucesso

// Verifica se o parâmetro 'id' foi passado pela URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte o parâmetro id para um número inteiro
    // Consulta a aula pelo id
    $sql = "SELECT * FROM aulas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $aula = $stmt->fetch();

    if (!$aula) {
        // Se não encontrar a aula, redireciona para a página de listagem
        header('Location: listar_aula.php');
        exit;
    }

} else {
    // Se não passar o id, redireciona para a página de listagem
    header('Location: listar_aula.php');
    exit;
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome_aula = trim($_POST['nome_aula']);
    $professor = trim($_POST['professor']);
    $quantidade_maxima = $_POST['quantidade_maxima'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

    // Valida os dados
    if (empty($nome_aula)) {
        $erro = "O nome da aula não pode estar vazio.";
    } elseif (empty($professor)) {
        $erro = "O nome do professor não pode estar vazio.";
    } elseif (!is_numeric($quantidade_maxima) || $quantidade_maxima <= 0) {
        $erro = "A quantidade máxima de pessoas deve ser um número positivo.";
    } elseif (!DateTime::createFromFormat('H:i', $hora_inicio)) {
        $erro = "O horário de início não é válido.";
    } elseif (!DateTime::createFromFormat('H:i', $hora_fim)) {
        $erro = "O horário final não é válido.";
    } elseif ($hora_inicio >= $hora_fim) {
        $erro = "O horário de início não pode ser maior ou igual ao horário final.";
    } else {
        // Prepara a consulta SQL para atualizar os dados
        $sql = "UPDATE aulas SET nome_aula = :nome_aula, professor = :professor, quantidade_maxima = :quantidade_maxima, hora_inicio = :hora_inicio, hora_fim = :hora_fim WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindParam(':nome_aula', $nome_aula);
        $stmt->bindParam(':professor', $professor);
        $stmt->bindParam(':quantidade_maxima', $quantidade_maxima);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fim', $hora_fim);
        $stmt->bindParam(':id', $id);

        // Executa a consulta
        if ($stmt->execute()) {
            // Se a atualização for bem-sucedida, redireciona de volta para a página de listagem
            header('Location: listar_aula.php');
            exit;
        } else {
            $erro = "Erro ao atualizar os dados da aula.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Título centralizado -->
    <h2 class="text-center">Editar Aula</h2>

    <!-- Exibe mensagem de erro, se houver -->
    <?php if ($erro): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <!-- Formulário de edição de aula -->
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nome_aula" class="form-label">Nome da Aula</label>
            <input type="text" class="form-control" id="nome_aula" name="nome_aula" value="<?php echo htmlspecialchars($aula['nome_aula']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="professor" class="form-label">Nome do Professor</label>
            <input type="text" class="form-control" id="professor" name="professor" value="<?php echo htmlspecialchars($aula['professor']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="quantidade_maxima" class="form-label">Quantidade Máxima de Pessoas</label>
            <input type="number" class="form-control" id="quantidade_maxima" name="quantidade_maxima" value="<?php echo htmlspecialchars($aula['quantidade_maxima']); ?>" required min="1">
        </div>
        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Horário de Início</label>
            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?php echo htmlspecialchars($aula['hora_inicio']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="hora_fim" class="form-label">Horário Final</label>
            <input type="time" class="form-control" id="hora_fim" name="hora_fim" value="<?php echo htmlspecialchars($aula['hora_fim']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

<!-- Botão para voltar ao menu -->
<div class="text-center mt-3">
    <a href="index2.php" class="btn btn-primary btn-lg m-2">Voltar ao menu</a>
</div>

</div>
    <div class="text-center mt-3">
        <a href="listar_aulas.php" class="btn btn-primary btn-lg m-2">Voltar para Lista de Aulas</a>
    </div>

</body>
</html>
