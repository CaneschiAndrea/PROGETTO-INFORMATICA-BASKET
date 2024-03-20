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

$query = "SELECT id, squadra1, squadra2, data_partita FROM partite";
$result = $conn->query($query);

$partite = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $partite[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Dati Partita - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222; /* Colore di sfondo scuro */
            color: #fff; /* Testo bianco */
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #555; /* Bordo inferiore grigio */
            text-align: left;
        }

        th {
            background-color: #333; /* Grigio scuro */
            color: #fff; /* Testo bianco */
        }

        tr:hover {
            background-color: #444; /* Grigio più scuro al passaggio del mouse */
            cursor: pointer; /* Cambia il cursore al passaggio del mouse */
        }
    </style>
</head>
<body>

<h2 style="color: green">Elenco Partite</h2>

<table>
    <thead>
        <tr>
            <th>Squadra 1</th>
            <th>Squadra 2</th>
            <th>Data Partita</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($partite as $partita): ?>
            <tr onclick="window.location.href='datipartita.php?id=<?php echo $partita['id']; ?>'">
                <td><?php echo $partita['squadra1']; ?></td>
                <td><?php echo $partita['squadra2']; ?></td>
                <td><?php echo $partita['data_partita']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="scelta.php" class="back-button">Torna a Scelta</a>

</body>
</html>
