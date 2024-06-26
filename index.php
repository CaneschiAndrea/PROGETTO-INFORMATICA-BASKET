<?php
$servername = "localhost";
$database = "progetto_basket";
$username = "root";  
$password = "";     
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password_hash FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password_hash"];

        if (password_verify($inputPassword, $hashedPassword)) {
            $message = "Login riuscito!";
            header("Location: scelta.php");
            exit();
        } else {
            $message = "Password errata. Riprova.";
        }
    } else {
        $message = "Username non valido. Riprova o registrati.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 40px;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Colore di sfondo della container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            background-color: #272727; /* Colore di sfondo degli input */
            color: #fff; /* Colore del testo degli input */
            border: none; /* Rimuove il bordo */
            border-radius: 4px;
        }

        input:focus {
            outline: none; /* Rimuove il focus border */
        }

        button {
            background-color: #0d6efd; /* Colore di sfondo del pulsante */
            color: #fff; /* Colore del testo del pulsante */
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0b5ed7; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        a {
            text-decoration: none;
            color: #0d6efd; /* Colore del link */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            /* Rimuovi opacity e transform dal CSS originale */
            animation: fadeIn 0.5s ease forwards; /* Applica l'animazione di fade-in */
        }

        p {
            opacity: 0; /* Inizialmente invisibile */
            animation: fadeIn 0.5s ease forwards; /* Applica l'animazione di fade-in */
            animation-delay: 0.5s; /* Ritardo di 0.5 secondi */
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login - Progetto Basket</h2>
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <p><?php echo $message; ?></p>
    <p>Non hai un account? <a href="registrazione.php">Registrati qui</a>.</p>
</div>

</body>
</html>
