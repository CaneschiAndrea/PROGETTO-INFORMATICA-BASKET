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
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Colore di sfondo della container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .atleta-item {
            margin-bottom: 10px;
        }

        .atleta-link {
            display: block;
            padding: 10px;
            background-color: #4caf50; /* Colore di sfondo dei pulsanti */
            color: white; /* Colore del testo dei pulsanti */
            text-decoration: none;
            border-radius: 4px;
        }

        .atleta-link:hover {
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

        .search-form {
            margin-top: 20px;
        }

        .search-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-button {
            padding: 8px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="elenco-container">
    <h2>Elenco Atleti</h2>
    <input type="text" id="search-input" class="search-input" placeholder="Cerca atleta per nome o cognome">
        <br>
        <br>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='atleta-item' data-nome='" . $row['nome'] . "' data-cognome='" . $row['cognome'] . "'><a href='dettagli_atleta.php?id=" . $row['id'] . "' class='atleta-link'>" . $row['nome'] . " " . $row['cognome'] . "</a></div>";
        }
    } else {
        echo "<p>Nessun atleta presente nel database.</p>";
    }
    ?>
</div>

<a href="scelta.php" class="back-button">Torna a Scelta</a>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('search-input');
        var atletaItems = document.querySelectorAll('.atleta-item');

        searchInput.addEventListener('input', function() {
            var searchTerm = this.value.trim().toLowerCase();

            atletaItems.forEach(function(item) {
                var nome = item.getAttribute('data-nome').toLowerCase();
                var cognome = item.getAttribute('data-cognome').toLowerCase();
                var searchString = nome + " " + cognome;

                if (searchString.includes(searchTerm)) {
                    item.style.display = 'block'; // Mostra l'atleta se corrisponde alla ricerca
                } else {
                    item.style.display = 'none'; // Nascondi l'atleta altrimenti
                }
            });
        });
    });
</script>
</body>
</html>

<?php
$conn->close();
?>
