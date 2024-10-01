<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM alunos WHERE id = $id";
    $result = $conn->query($sql);
    $aluno = $result->fetch_assoc();

    if (!$aluno) {
        echo "Aluno não encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    $sql = "UPDATE alunos SET nome='$nome', idade='$idade', email='$email', curso='$curso' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Aluno atualizado com sucesso.";
        header("Location: index.php"); 
        exit;
    } else {
        echo "Erro ao atualizar aluno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>
        
        <form action="" method="POST" class="form-cadastro">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required pattern="[A-Za-z]+">

            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" value="<?php echo htmlspecialchars($aluno['idade']); ?>" required min="1" max="120">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($aluno['email']); ?>" required>

            <label for="curso">Curso:</label>
            <input type="text" name="curso" id="curso" value="<?php echo htmlspecialchars($aluno['curso']); ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
