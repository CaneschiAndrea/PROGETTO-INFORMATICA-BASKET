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

$sql = "SELECT id, nome, cognome FROM dati_atleta";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Dati Atleta - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 40px;
        }

        .elenco-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Colore di sfondo della container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #4caf50; /* Colore di sfondo dei pulsanti */
            color: white; /* Colore del testo dei pulsanti */
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #f44336; /* Colore di sfondo del pulsante Torna a Scelta */
            color: white; /* Colore del testo del pulsante Torna a Scelta */
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #d32f2f; /* Cambia il colore di sfondo del pulsante al passaggio del mouse */
        }
    </style>
</head>
<body>

<div class="elenco-container">
    <h2>Elenco Atleti</h2>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href='dettagli_atleta.php?id=" . $row['id'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</a>";
        }
    } else {
        echo "Nessun atleta presente nel database.";
    }
    ?>

</div>


<a href="scelta.php" class="back-button">Torna a Scelta</a>

</body>
</html>

<?php
$conn->close();
?>