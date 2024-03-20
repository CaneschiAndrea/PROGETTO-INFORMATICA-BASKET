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

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];

    $stmt = $conn->prepare("SELECT id FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $newUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "Username già in uso. Scegli un altro.";
    } else {
        $hashedPassword = hashPassword($newPassword);

        $stmt = $conn->prepare("INSERT INTO utenti (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $newUsername, $hashedPassword);

        if ($stmt->execute()) {
            $message = "Registrazione completata con successo!";
        } else {
            $message = "Errore durante la registrazione. Riprova.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .registrazione-container {
            text-align: center;
            background-color: #1f1f1f; /* Colore di sfondo della container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #fff; /* Colore del testo dell'intestazione */
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff; /* Colore del testo delle etichette */
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
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
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 16px;
            color: #ccc; /* Colore del testo dei paragrafi */
        }

        a {
            text-decoration: none;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="registrazione-container">
    <h2>Registrazione - Progetto Basket</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="new_username">Nuovo Username:</label>
        <input type="text" id="new_username" name="new_username" required>

        <label for="new_password">Nuova Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <button type="submit">Aggiungi</button>
    </form>
    <p><?php echo $message; ?></p>
    <p>Hai già un account? <a href="index.php">Effettua il login qui</a>.</p>
</div>

</body>
</html>
