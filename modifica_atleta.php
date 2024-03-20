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

// Controllo se è stato passato l'ID dell'atleta
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $atleta_id = $_GET['id'];

    // Query per ottenere i dettagli dell'atleta
    $stmt = $conn->prepare("SELECT * FROM dati_atleta WHERE id = ?");
    $stmt->bind_param("i", $atleta_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se l'atleta è stato trovato
    if ($result->num_rows > 0) {
        $atleta = $result->fetch_assoc();
    } else {
        echo "Atleta non trovato.";
        exit();
    }
} else {
    // Messaggio di errore se l'ID atleta non è specificato o non è un numero valido
    echo "ID atleta non specificato o non valido.";
    exit();
}

// Gestione dell'eliminazione
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stmt_delete = $conn->prepare("DELETE FROM dati_atleta WHERE id = ?");
    $stmt_delete->bind_param("i", $atleta_id);

    if ($stmt_delete->execute()) {
        $message = "Dati atleta eliminati con successo!";
    } else {
        $message = "Errore durante l'eliminazione dei dati. Riprova.";
    }
}

// Gestione del salvataggio dei dati
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Assicurati che tutti i campi siano stati inviati correttamente
    if (!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['data_nascita']) && !empty($_POST['paese_nascita']) && !empty($_POST['altezza']) && !empty($_POST['peso']) && !empty($_POST['stagione']) && !empty($_POST['partite_giocate']) && !empty($_POST['media_punti']) && !empty($_POST['rimbalzi']) && !empty($_POST['assist']) && !empty($_POST['percentuale_campo']) && !empty($_POST['percentuale_da3']) && !empty($_POST['percentuale_tiro_libero'])) {
        // Aggiorna i dati dell'atleta nel database con i nuovi valori
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $data_nascita = $_POST['data_nascita'];
        $paese_nascita = $_POST['paese_nascita'];
        $altezza = $_POST['altezza'];
        $peso = $_POST['peso'];
        $stagione = $_POST['stagione'];
        $partite_giocate = $_POST['partite_giocate'];
        $media_punti = $_POST['media_punti'];
        $rimbalzi = $_POST['rimbalzi'];
        $assist = $_POST['assist'];
        $percentuale_campo = $_POST['percentuale_campo'];
        $percentuale_da3 = $_POST['percentuale_da3'];
        $percentuale_tiro_libero = $_POST['percentuale_tiro_libero'];

        $stmt_update = $conn->prepare("UPDATE dati_atleta SET nome=?, cognome=?, data_nascita=?, paese_nascita=?, altezza=?, peso=?, stagione=?, partite_giocate=?, media_punti=?, rimbalzi=?, assist=?, percentuale_campo=?, percentuale_da3=?, percentuale_tiro_libero=? WHERE id=?");
        $stmt_update->bind_param("ssssiiiiiiiiiii", $nome, $cognome, $data_nascita, $paese_nascita, $altezza, $peso, $stagione, $partite_giocate, $media_punti, $rimbalzi, $assist, $percentuale_campo, $percentuale_da3, $percentuale_tiro_libero, $atleta_id);

        if ($stmt_update->execute()) {
            $message = "Dati atleta aggiornati con successo!";
        } else {
            $message = "Errore durante l'aggiornamento dei dati. Riprova.";
        }
    } else {
        $message = "Assicurati di compilare tutti i campi.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Dati Atleta - Progetto Basket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    
</head>
<body>

<div class="modifica-container">
    <h2><i class="fas fa-user-edit"></i> Modifica Dati Atleta</h2>

    <form method="post">
    <label for="nome">Nome:</label>
<input type="text" id="nome" name="nome" value="<?php echo $atleta['nome']; ?>" required>

<label for="cognome">Cognome:</label>
<input type="text" id="cognome" name="cognome" value="<?php echo $atleta['cognome']; ?>" required>

<label for="data_nascita">Data di Nascita:</label>
<input type="date" id="data_nascita" name="data_nascita" value="<?php echo $atleta['data_nascita']; ?>" required>


        <label for="paese_nascita">Paese di Nascita:</label>
        <input type="text" id="paese_nascita" name="paese_nascita" value="<?php echo htmlspecialchars($atleta['paese_nascita']); ?>" required>

        <label for="altezza">Altezza (cm):</label>
        <input type="number" id="altezza" name="altezza" value="<?php echo $atleta['altezza']; ?>" required>

        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" value="<?php echo $atleta['peso']; ?>" required>

        <label for="stagione">Stagione:</label>
        <input type="text" id="stagione" name="stagione" value="<?php echo htmlspecialchars($atleta['stagione']); ?>" required>

        <label for="partite_giocate">Partite Giocate:</label>
        <input type="number" id="partite_giocate" name="partite_giocate" value="<?php echo $atleta['partite_giocate']; ?>" required>

        <label for="media_punti">Media Punti:</label>
        <input type="number" id="media_punti" name="media_punti" value="<?php echo $atleta['media_punti']; ?>" required>

        <label for="rimbalzi">Rimbalzi:</label>
        <input type="number" id="rimbalzi" name="rimbalzi" value="<?php echo $atleta['rimbalzi']; ?>" required>

        <label for="assist">Assist:</label>
        <input type="number" id="assist" name="assist" value="<?php echo $atleta['assist']; ?>" required>

        <label for="percentuale_campo">Percentuale Campo:</label>
        <input type="number" id="percentuale_campo" name="percentuale_campo" value="<?php echo $atleta['percentuale_campo']; ?>" required>

        <label for="percentuale_da3">Percentuale da 3:</label>
        <input type="number" id="percentuale_da3" name="percentuale_da3" value="<?php echo $atleta['percentuale_da3']; ?>" required>

        <label for="percentuale_tiro_libero">Percentuale Tiro Libero:</label>
        <input type="number" id="percentuale_tiro_libero" name="percentuale_tiro_libero" value="<?php echo $atleta['percentuale_tiro_libero']; ?>" required>

        <button type="submit"><i class="fas fa-save"></i> Salva Modifiche</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p class="<?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <a href="dettagli_atleta.php?id=<?php echo $atleta_id; ?>" class="back-button"><i class="fas fa-arrow-left"></i> Annulla</a>
</div>

</body>
</html>


<?php
$conn->close();
?>