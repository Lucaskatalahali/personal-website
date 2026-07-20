<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Extrai a parte antes do @
    $user = explode("@", $email)[0];

    if (empty($email) || empty($password)) {
        // Se o campo estiver vazio, redireciona para o login
        header("Location: ../login.html");
        exit();
    }

    // Verifica se o e-mail é válido e termina com @sakarya.edu.tr
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, "@sakarya.edu.tr")) {
        // Se não for um e-mail válido, redireciona para o login
        header("Location: ../login.html");
        exit();
    }
    // Verifica se o nome de usuário tem 1 letra seguida de 9 números
    if (!preg_match('/^[a-zA-Z][0-9]{9}$/', $user)) {
        header("Location: ../login.html");
        exit();
    }

    // Verifica se a senha é igual ao nome de usuário (sem domínio)
    if ($password === $user) {
        // Login bem-sucedido
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Bem-vindo</title>
            <style>
                body {
                    background-color: #f0f0f0;
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .message-box {
                    background: white;
                    padding: 30px;
                    border-radius: 12px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                    text-align: center;
                }
                .message-box h2 {
                    color: green;
                }
                .message-box a {
                    display: inline-block;
                    margin-top: 15px;
                    text-decoration: none;
                    color: white;
                    background: #720808;
                    padding: 10px 20px;
                    border-radius: 8px;
                }
            </style>
        </head>
        <body>
            <div class='message-box'>
                <h2>Welcome, $user</h2>
                <a href='../index.html'>Go to homepage</a>
            </div>
        </body>
        </html>";
       
    } else {
        // Login falhado
        header("Location: ../login.html");
        exit();
    }

} else {
    // Se o método de requisição não for POST, redireciona para o login
    header("Location: login.html");
    exit();
}
?>
