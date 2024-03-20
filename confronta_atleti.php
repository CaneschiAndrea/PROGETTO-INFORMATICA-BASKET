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

$sql_atleti = "SELECT id, nome, cognome FROM dati_atleta";
$result_atleti = $conn->query($sql_atleti);

$message = "";
$atleta1 = $atleta2 = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atleta1_id = isset($_POST["atleta1"]) ? $_POST["atleta1"] : null;
    $atleta2_id = isset($_POST["atleta2"]) ? $_POST["atleta2"] : null;

    if ($atleta1_id && $atleta2_id) {
        $stmt_atleta1 = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
        $stmt_atleta1->bind_param("i", $atleta1_id);
        $stmt_atleta1->execute();
        $result_atleta1 = $stmt_atleta1->get_result();

        $stmt_atleta2 = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
        $stmt_atleta2->bind_param("i", $atleta2_id);
        $stmt_atleta2->execute();
        $result_atleta2 = $stmt_atleta2->get_result();

        if ($result_atleta1->num_rows > 0 && $result_atleta2->num_rows > 0) {
            $atleta1 = $result_atleta1->fetch_assoc();
            $atleta2 = $result_atleta2->fetch_assoc();

            unset($atleta1['paese_di_nascita']);
            unset($atleta2['paese_di_nascita']);
        } else {
            $message = "Seleziona due atleti validi.";
        }
    } else {
        $message = "Seleziona due atleti.";
    }
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confronta Atleti - Progetto Basket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        .confronta-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Colore di sfondo della container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0;
            font-size: 16px;
            color: #fff; /* Colore del testo delle label */
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #272727; /* Colore di sfondo degli input */
            color: #fff; /* Colore del testo degli input */
            border: none; /* Rimuove il bordo */
            border-radius: 4px;
        }

        select:focus {
            outline: none; /* Rimuove il focus border */
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .result-container {
            margin-top: 20px;
            font-size: 16px;
            color: #fff; /* Colore del testo dei risultati */
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
        }

        .valore-maggiore {
            background-color: #aaffaa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="confronta-container">
    <h2>Confronta Atleti</h2>

    <form method="post">
        <label for="atleta1">Seleziona il primo atleta:</label>
        <select id="atleta1" name="atleta1" required>
            <?php
            while ($row = $result_atleti->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nome'] . " " . $row['cognome']) . "</option>";
            }
            ?>
        </select>

        <label for="atleta2">Seleziona il secondo atleta:</label>
        <select id="atleta2" name="atleta2" required>
            <?php
            $result_atleti->data_seek(0);
            while ($row = $result_atleti->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nome'] . " " . $row['cognome']) . "</option>";
            }
            ?>
        </select>

        <button type="submit">Confronta Atleti</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (!empty($atleta1) && !empty($atleta2)) : ?>
        <div class="result-container">
            <h3>Risultati del Confronto:</h3>

            <table>
                <tr>
                    <th>Statistica</th>
                    <th><?php echo $atleta1['nome']; ?></th>
                    <th><?php echo $atleta2['nome']; ?></th>
                </tr>

                <?php
                $atleta1_data = array_slice($atleta1, 3); 
                $atleta2_data = array_slice($atleta2, 3); 

                foreach ($atleta1_data as $stat => $value1) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($stat) . "</td>";
                    echo "<td class='" . (($value1 > $atleta2_data[$stat]) ? 'valore-maggiore' : '') . "'>" . htmlspecialchars($value1) . "</td>";
                    echo "<td class='" . (($atleta2_data[$stat] > $value1) ? 'valore-maggiore' : '') . "'>" . htmlspecialchars($atleta2_data[$stat]) . "</td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    <?php endif; ?>

    <a href="scelta.php" class="back-button">Torna a Scelta</a>

</div>

</body>
</html>

<?php
$conn->close();
?>
