<?php
// Conexão com o banco de dados
$host = "localhost";
$dbname = "locadora";
$username = "root";
$password = "";

// Conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Recebendo os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, cpf, telefone, endereco, email, senha) VALUES (:nome, :cpf, :telefone, :endereco, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':telefone' => $telefone,
            ':endereco' => $endereco,
            ':email' => $email,
            ':senha' => $senha
        ]);
        echo "Usuário cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar usuário: E-mail ou Senha Inválidos " . $e->getMessage();
    }
}
?>