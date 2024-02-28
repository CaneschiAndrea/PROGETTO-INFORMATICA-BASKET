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

// Ottenere la lista di atleti per il menu a discesa
$sql_atleti = "SELECT id, nome, cognome FROM dati_atleta";
$result_atleti = $conn->query($sql_atleti);

$message = "";
$atleta1 = $atleta2 = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atleta1_id = $_POST["atleta1"];
    $atleta2_id = $_POST["atleta2"];

    // Ottenere i dati del primo atleta
    $stmt_atleta1 = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
    $stmt_atleta1->bind_param("i", $atleta1_id);
    $stmt_atleta1->execute();
    $result_atleta1 = $stmt_atleta1->get_result();

    // Ottenere i dati del secondo atleta
    $stmt_atleta2 = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
    $stmt_atleta2->bind_param("i", $atleta2_id);
    $stmt_atleta2->execute();
    $result_atleta2 = $stmt_atleta2->get_result();

    if ($result_atleta1->num_rows > 0 && $result_atleta2->num_rows > 0) {
        $atleta1 = $result_atleta1->fetch_assoc();
        $atleta2 = $result_atleta2->fetch_assoc();
    } else {
        $message = "Seleziona due atleti validi.";
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
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        .confronta-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0;
            font-size: 16px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 16px;
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

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .valore-maggiore {
            background-color: #aaffaa;
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
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</option>";
            }
            ?>
        </select>

        <label for="atleta2">Seleziona il secondo atleta:</label>
        <select id="atleta2" name="atleta2" required>
            <?php
            // Riposiziona il puntatore del risultato per la seconda select
            $result_atleti->data_seek(0);
            while ($row = $result_atleti->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</option>";
            }
            ?>
        </select>

        <button type="submit">Confronta Atleti</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p class="error"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($atleta1) && isset($atleta2)) : ?>
        <div class="result-container">
            <h3>Risultati del Confronto:</h3>

            <table style="width:100%; border-collapse: collapse;">
                <tr>
                    <th>Statistica</th>
                    <th><?php echo $atleta1['nome']; ?></th>
                    <th><?php echo $atleta2['nome']; ?></th>
                </tr>

                <tr>
                    <td>Altezza</td>
                    <td class="<?php echo ($atleta1['altezza'] > $atleta2['altezza']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['altezza']; ?> cm
                    </td>
                    <td class="<?php echo ($atleta2['altezza'] > $atleta1['altezza']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['altezza']; ?> cm
                    </td>
                </tr>

                <tr>
                    <td>Peso</td>
                    <td class="<?php echo ($atleta1['peso'] > $atleta2['peso']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['peso']; ?> kg
                    </td>
                    <td class="<?php echo ($atleta2['peso'] > $atleta1['peso']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['peso']; ?> kg
                    </td>
                </tr>

                <tr>
                    <td>Partite Giocate</td>
                    <td class="<?php echo ($atleta1['partite_giocate'] > $atleta2['partite_giocate']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['partite_giocate']; ?>
                    </td>
                    <td class="<?php echo ($atleta2['partite_giocate'] > $atleta1['partite_giocate']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['partite_giocate']; ?>
                    </td>
                </tr>

                <tr>
                    <td>Media Punti</td>
                    <td class="<?php echo ($atleta1['media_punti'] > $atleta2['media_punti']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['media_punti']; ?>
                    </td>
                    <td class="<?php echo ($atleta2['media_punti'] > $atleta1['media_punti']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['media_punti']; ?>
                    </td>
                </tr>

                <tr>
                    <td>Rimbalzi</td>
                    <td class="<?php echo ($atleta1['rimbalzi'] > $atleta2['rimbalzi']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['rimbalzi']; ?>
                    </td>
                    <td class="<?php echo ($atleta2['rimbalzi'] > $atleta1['rimbalzi']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['rimbalzi']; ?>
                    </td>
                </tr>

                <tr>
                    <td>Assist</td>
                    <td class="<?php echo ($atleta1['assist'] > $atleta2['assist']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['assist']; ?>
                    </td>
                    <td class="<?php echo ($atleta2['assist'] > $atleta1['assist']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['assist']; ?>
                    </td>
                </tr>

                <tr>
                    <td>Percentuale Campo</td>
                    <td class="<?php echo ($atleta1['percentuale_campo'] > $atleta2['percentuale_campo']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['percentuale_campo']; ?>%
                    </td>
                    <td class="<?php echo ($atleta2['percentuale_campo'] > $atleta1['percentuale_campo']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['percentuale_campo']; ?>%
                    </td>
                </tr>

                <tr>
                    <td>Percentuale da 3</td>
                    <td class="<?php echo ($atleta1['percentuale_da3'] > $atleta2['percentuale_da3']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['percentuale_da3']; ?>%
                    </td>
                    <td class="<?php echo ($atleta2['percentuale_da3'] > $atleta1['percentuale_da3']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['percentuale_da3']; ?>%
                    </td>
                </tr>

                <tr>
                    <td>Percentuale Tiro Libero</td>
                    <td class="<?php echo ($atleta1['percentuale_tiro_libero'] > $atleta2['percentuale_tiro_libero']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta1['percentuale_tiro_libero']; ?>%
                    </td>
                    <td class="<?php echo ($atleta2['percentuale_tiro_libero'] > $atleta1['percentuale_tiro_libero']) ? 'valore-maggiore' : ''; ?>">
                        <?php echo $atleta2['percentuale_tiro_libero']; ?>%
                    </td>
                </tr>

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
