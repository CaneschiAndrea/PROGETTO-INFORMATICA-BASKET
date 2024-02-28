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
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $dataNascita = $_POST["data_nascita"];
    $paeseNascita = $_POST["paese_nascita"];
    $altezza = $_POST["altezza"];
    $peso = $_POST["peso"];

    $stmt = $conn->prepare("INSERT INTO dati_atleta (nome, cognome, data_nascita, paese_nascita, altezza, peso) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $nome, $cognome, $dataNascita, $paeseNascita, $altezza, $peso);

    if ($stmt->execute()) {
        $message = "Dati atleta aggiunti con successo!";
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
    <title>Aggiungi Dati Atleta - Progetto Basket</title>
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
            background-color: green;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px; /* Spazio in basso */
        }

        button:hover {
            background-color: #d32f2f;
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
    <h2>Aggiungi Dati Atleta</h2>
    <form action="aggiungi_dati_atleta.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required>

        <label for="data_nascita">Data di Nascita:</label>
        <input type="date" id="data_nascita" name="data_nascita" required>

        <label for="paese_nascita">Paese di Nascita:</label>
        <input type="text" id="paese_nascita" name="paese_nascita" required>

        <label for="altezza">Altezza (cm):</label>
        <input type="number" id="altezza" name="altezza" required>

        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" required>

        <button type="submit">Aggiungi Dati Atleta</button>
    </form>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
    <a href="scelta.php"><button style="background-color: #f44336;">Torna a Scelta</button></a>
</div>

</body>
</html>