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
    $season = $_POST["season"];
    $partite_giocate = $_POST["partite_giocate"];
    $media_punti = $_POST["media_punti"];
    $rimbalzi = $_POST["rimbalzi"];
    $assist = $_POST["assist"];
    $percentuale_campo = $_POST["percentuale_campo"];
    $percentuale_da3 = $_POST["percentuale_da3"];
    $percentuale_tiro_libero = $_POST["percentuale_tiro_libero"];

    $stmt = $conn->prepare("INSERT INTO dati_atleta (nome, cognome, data_nascita, paese_nascita, altezza, peso, stagione, partite_giocate, media_punti, rimbalzi, assist, percentuale_campo, percentuale_da3, percentuale_tiro_libero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiisiiiddd", $nome, $cognome, $dataNascita, $paeseNascita, $altezza, $peso, $season, $partite_giocate, $media_punti, $rimbalzi, $assist, $percentuale_campo, $percentuale_da3, $percentuale_tiro_libero);

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
            margin-top: 20px; 
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
        
        <label for="season">Stagione:</label>
        <input type="text" id="season" name="season" required>

        <label for="partite_giocate">Partite Giocate:</label>
        <input type="number" id="partite_giocate" name="partite_giocate" required>

        <label for="media_punti">Media Punti:</label>
        <input type="number" step="0.1" id="media_punti" name="media_punti" required>

        <label for="rimbalzi">Rimbalzi:</label>
        <input type="number" id="rimbalzi" name="rimbalzi" required>

        <label for="assist">Assist:</label>
        <input type="number" id="assist" name="assist" required>

        <label for="percentuale_campo">Percentuale dal Campo:</label>
        <input type="number" step="0.1" id="percentuale_campo" name="percentuale_campo" required>

        <label for="percentuale_da3">Percentuale da 3:</label>
        <input type="number" step="0.1" id="percentuale_da3" name="percentuale_da3" required>

        <label for="percentuale_tiro_libero">Percentuale Tiro Libero:</label>
        <input type="number" step="0.1" id="percentuale_tiro_libero" name="percentuale_tiro_libero" required>

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