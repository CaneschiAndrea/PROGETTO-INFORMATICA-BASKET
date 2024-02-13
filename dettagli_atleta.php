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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $atleta_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
    $stmt->bind_param("i", $atleta_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $atleta = $result->fetch_assoc();
    } else {
        echo "Atleta non trovato.";
        exit();
    }
} else {
    echo "ID atleta non specificato.";
    exit();
}

// Gestione dell'eliminazione
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stmt_delete = $conn->prepare("DELETE FROM dati_atleta WHERE id = ?");
    $stmt_delete->bind_param("i", $atleta_id);

    if ($stmt_delete->execute()) {
        $message = "Dati atleta eliminati con successo!";
        // Puoi anche reindirizzare l'utente a una pagina di conferma o altrove dopo l'eliminazione
        // header("Location: conferma_eliminazione.php");
        // exit();
    } else {
        $message = "Errore durante l'eliminazione dei dati. Riprova.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Atleta - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px;
        }

        .dettagli-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            text-align: left;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="dettagli-container">
    <h2>Dettagli Atleta</h2>
    <p><strong>Nome:</strong> <?php echo $atleta['nome']; ?></p>
    <p><strong>Cognome:</strong> <?php echo $atleta['cognome']; ?></p>
    <p><strong>Data di Nascita:</strong> <?php echo $atleta['data_nascita']; ?></p>
    <p><strong>Paese di Nascita:</strong> <?php echo $atleta['paese_nascita']; ?></p>
    <p><strong>Altezza:</strong> <?php echo $atleta['altezza']; ?> cm</p>
    <p><strong>Peso:</strong> <?php echo $atleta['peso']; ?> kg</p>

    <?php if (!empty($message)) : ?>
        <p class="<?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questi dati?');">
        <input type="hidden" name="delete">
        <button type="submit" class="delete-button">Elimina Dati Atleta</button>
    </form>

    <a href="scelta.php" class="back-button">Torna a Scelta</a>

</div>

</body>
</html>

<?php
$conn->close();
?>