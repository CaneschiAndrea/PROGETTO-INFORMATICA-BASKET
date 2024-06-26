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

$id_partita = $_GET['id'];

$query = "SELECT * FROM partite WHERE id = $id_partita";
$result = $conn->query($query);

$partita = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("DELETE FROM partite WHERE id = ?");
    $stmt->bind_param("i", $id_partita);

    if ($stmt->execute()) {
        header("Location: visualizza_dati_partita.php");
        exit();
    } else {
        echo "Errore durante l'eliminazione della partita.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dati Partita - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222; /* Colore di sfondo scuro */
            color: #fff; /* Testo bianco */
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        h2 {
            color: #4caf50; /* Verde */
        }

        .data {
            margin-bottom: 10px;
            color: #ddd; /* Testo grigio chiaro */
        }

        .back-button, .delete-button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-button {
            background-color: #4caf50; /* Verde */
            color: #fff; /* Testo bianco */
        }

        .delete-button {
            background-color: #f44336; /* Rosso */
            color: #fff; /* Testo bianco */
        }

        .back-button:hover, .delete-button:hover {
            filter: brightness(90%); /* Leggera riduzione della luminosità al passaggio del mouse */
        }
    </style>
</head>
<body>

<h2>Dati Partita</h2>

<div class="data">
    <strong>Squadra 1:</strong> <?php echo $partita['squadra1']; ?>
</div>
<div class="data">
    <strong>Punteggio Squadra 1:</strong> <?php echo $partita['punteggio_squadra1']; ?>
</div>
<div class="data">
    <strong>Punteggio Squadra 2:</strong> <?php echo $partita['punteggio_squadra2']; ?>
</div>
<div class="data">
    <strong>Squadra 2:</strong> <?php echo $partita['squadra2']; ?>
</div>
<div class="data">
    <strong>Data Partita:</strong> <?php echo $partita['data_partita']; ?>
</div>

<form method="post">
    <input type="submit" value="Elimina Partita" class="delete-button" onclick="return confirm('Sei sicuro di voler eliminare questa partita?');">
</form>

<a href="visualizza_dati_partita.php" class="back-button">Torna Indietro</a>
<br>
<a href="scelta.php" class="back-button">Torna a Scelta</a>

</body>
</html>
