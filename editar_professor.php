<?php
require 'config.php';

$erro = ''; // Inicializa a variável de erro
$sucesso = ''; // Inicializa a variável de sucesso

if (isset($_GET['id'])) {
$id = intval($_GET['id']);
$sql = "SELECT * FROM professores WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$professor = $stmt->fetch();


if (!$professor) {
    header('Location: exibir_professores.php');
    exit;
}


} else {
header('Location: exibir_professores.php');
exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Coleta os dados do formulário
$nome = trim($_POST['nome']);
$especialidade = trim($_POST['especialidade']);
$telefone = trim($_POST['telefone']);
$email = trim($_POST['email']);
$sexo = $_POST['sexo'];


// Valida os dados
if (empty($nome)) {
    $erro = "O nome não pode estar vazio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro = "O e-mail fornecido não é válido.";
} elseif (!preg_match('/^\\d{10,11}$/', $telefone)) {
    $erro = "O telefone deve conter apenas números e ter 10 ou 11 dígitos.";
} else {
    // Prepara a consulta SQL para atualizar os dados
    $sql = "UPDATE professores SET nome = :nome, especialidade = :especialidade, telefone = :telefone, email = :email, sexo = :sexo WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Vincula os parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':especialidade', $especialidade);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':id', $id);

    // Executa a consulta
    if ($stmt->execute()) {
        header('Location: exibir_professores.php');
        exit;
    } else {
        $erro = "Erro ao atualizar o cadastro do professor.";
    }
}



}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Cadastro de Professor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Editar Cadastro de Professor</h2>


    <?php if ($erro): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($professor['nome']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade</label>
            <input type="text" class="form-control" id="especialidade" name="especialidade" value="<?php echo htmlspecialchars($professor['especialidade']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($professor['telefone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($professor['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo" required>
                <option value="Masculino" <?php echo ($professor['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="Feminino" <?php echo ($professor['sexo'] == 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>



</body>
</html>