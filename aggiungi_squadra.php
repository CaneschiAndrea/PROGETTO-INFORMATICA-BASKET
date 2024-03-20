<?php
$servername = "localhost";
$database = "progetto_basket";
$username = "root";
$password = "";
$port = 3306;

// Connessione al database
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Variabile per il messaggio di feedback
$message = "";

// Gestione del submit del form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se i campi sono stati compilati
    if (!empty($_POST['nome_squadra']) && !empty($_POST['citta'])) {
        $nome_squadra = $_POST['nome_squadra'];
        $citta = $_POST['citta'];

        // Prepara la query per l'inserimento della nuova squadra
        $stmt = $conn->prepare("INSERT INTO squadre (nome_squadra, citta) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome_squadra, $citta);

        // Esecuzione della query
        if ($stmt->execute()) {
            $message = "Squadra aggiunta con successo!";
        } else {
            $message = "Errore durante l'aggiunta della squadra. Riprova.";
        }
    } else {
        $message = "Assicurati di compilare tutti i campi.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Squadra - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #444;
            color: #fff;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 20px;
            color: green;
        }

        .return-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .return-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Aggiungi Squadra</h2>
    <form method="post">
        <input type="text" name="nome_squadra" placeholder="Nome Squadra" required>
        <input type="text" name="citta" placeholder="Città" required>
        <button type="submit">Aggiungi Squadra</button>
    </form>
    <div class="message"><?php echo $message; ?></div>
    <a href="scelta.php" class="return-button">Torna a Scelta</a>
</div>

</body>
</html>

<?php
$conn->close(); 
?>
