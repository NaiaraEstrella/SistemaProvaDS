<?php
require 'config.php'; // Arquivo de configuração para conexão com o banco de dados

$sucesso = '';
$erro = '';

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
        // Prepara a consulta SQL para inserir os dados
        $sql = "INSERT INTO aulas (nome_aula, professor, quantidade_maxima, hora_inicio, hora_fim)
                VALUES (:nome_aula, :professor, :quantidade_maxima, :hora_inicio, :hora_fim)";
        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindParam(':nome_aula', $nome_aula);
        $stmt->bindParam(':professor', $professor);
        $stmt->bindParam(':quantidade_maxima', $quantidade_maxima);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fim', $hora_fim);

        // Executa a consulta
        if ($stmt->execute()) {
            $sucesso = "Cadastro de aula realizado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar a aula.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Cadastro de Aula</h2>

        <?php if ($sucesso): ?>
            <div class="alert alert-success"><?php echo $sucesso; ?></div>
        <?php endif; ?>
        <?php if ($erro): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="nome_aula" class="form-label">Nome da Aula</label>
                <input type="text" class="form-control" id="nome_aula" name="nome_aula" required>
            </div>
            <div class="mb-3">
                <label for="professor" class="form-label">Nome do Professor</label>
                <input type="text" class="form-control" id="professor" name="professor" required>
            </div>
            <div class="mb-3">
                <label for="quantidade_maxima" class="form-label">Quantidade Máxima de Pessoas</label>
                <input type="number" class="form-control" id="quantidade_maxima" name="quantidade_maxima" required min="1">
            </div>
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Horário de Início</label>
                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
            </div>
            <div class="mb-3">
                <label for="hora_fim" class="form-label">Horário Final</label>
                <input type="time" class="form-control" id="hora_fim" name="hora_fim" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Aula</button>
        </form>
    </div>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-primary btn-lg m-2">Voltar ao menu</a>
    </div>
</body>
</html>
