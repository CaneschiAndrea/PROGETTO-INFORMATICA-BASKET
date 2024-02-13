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
    $squadra1 = $_POST["squadra1"];
    $squadra2 = $_POST["squadra2"];
    $punteggioSquadra1 = $_POST["punteggio_squadra1"];
    $punteggioSquadra2 = $_POST["punteggio_squadra2"];
    $luogo = $_POST["luogo"];
    $dataPartita = $_POST["data_partita"];

    $risultatoFinale = $punteggioSquadra1 . " - " . $punteggioSquadra2;

    $stmt = $conn->prepare("INSERT INTO partite (squadra1, squadra2, punteggio_squadra1, punteggio_squadra2, luogo, data_partita) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiis", $squadra1, $squadra2, $punteggioSquadra1, $punteggioSquadra2, $luogo, $dataPartita);

    if ($stmt->execute()) {
        $message = "Dati partita aggiunti con successo!";
    } else {
        $message = "Errore durante l'aggiunta dei dati. Riprova.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Partita - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
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
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Aggiungi Partita</h2>
    <form action="aggiungi_partita.php" method="post">
        <label for="squadra1">Squadra 1:</label>
        <input type="text" id="squadra1" name="squadra1" required>

        <label for="squadra2">Squadra 2:</label>
        <input type="text" id="squadra2" name="squadra2" required>

        <label for="punteggio_squadra1">Punteggio Squadra 1:</label>
        <input type="number" id="punteggio_squadra1" name="punteggio_squadra1" required>

        <label for="punteggio_squadra2">Punteggio Squadra 2:</label>
        <input type="number" id="punteggio_squadra2" name="punteggio_squadra2" required>

        <label for="luogo">Luogo:</label>
        <input type="text" id="luogo" name="luogo" required>

        <label for="data_partita">Data Partita:</label>
        <input type="date" id="data_partita" name="data_partita" required>

        <button type="submit">Aggiungi Partita</button>
    </form>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
</div>

</body>
</html>