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

        .search-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #555;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>

<h2 style="color: green">Elenco Partite</h2>

<input type="text" id="searchInput" class="search-input" onkeyup="filterTable()" placeholder="Cerca per squadra...">

<table id="partiteTable">
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

<script>
function filterTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("partiteTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}
</script>

</body>
</html>
