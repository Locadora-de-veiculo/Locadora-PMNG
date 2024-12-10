<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'locadora';
$user = 'root'; // Usuário padrão
$password = ''; // Senha padrão (alterar se necessário)

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Consultar usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = MD5(:senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Usuário autenticado
        echo "Login bem-sucedido! Seja bem-vindo.";
    } else {
        // Credenciais inválidas
        echo "E-mail ou senha incorretos.";
    }
}
?>