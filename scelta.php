<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scelta - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 40px;
            position: relative; /* Per posizionare l'elemento figlio in base a questa posizione */
        }

        .scelta-container {
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
            padding: 12px 20px;
            background-color: #4caf50; /* Colore di sfondo dei pulsanti */
            color: #fff; /* Colore del testo dei pulsanti */
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease; /* Effetto di transizione */
        }

        a:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        .logout-button {
            background-color: #f44336; /* Colore di sfondo del pulsante di logout */
        }

        .logout-button:hover {
            background-color: #d32f2f; /* Cambia il colore di sfondo del pulsante di logout al passaggio del mouse */
        }

        .info-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #4caf50; /* Colore di sfondo del pulsante */
            color: #fff; /* Colore del testo del pulsante */
            border-radius: 50%; /* Per rendere il pulsante un cerchio */
            font-size: 24px;
            line-height: 50px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease; /* Effetto di transizione */
        }

        .info-button:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        h2 {
            margin-top: 0;
            color: #4caf50; /* Colore del titolo */
        }
    </style>
</head>
<body>

<div style="font-size: 24px; margin-bottom: 20px;" id="clock">Loading...</div>

<div class="scelta-container">
    <h2>Scegli un'opzione</h2>
    <a href="visualizza_dati_atleta.php">Visualizza dati atleta</a>
    <a href="visualizza_dati_partita.php">Visualizza dati partita</a>
    <a href="inserisci_partita.php">Inserisci partita</a>
    <a href="confronta_atleti.php">Confronta due atleti</a>
    <a href="aggiungi_dati_atleta.php">Aggiungi dati atleta</a> 
    <a href="aggiungi_squadra.php">Aggiungi squadra</a>
    <a href="calendario.php">Calendario Partite</a>
    <a href="index.php" class="logout-button">Logout</a>
    <a href="informazioni.php" class="info-button">?</a>
</div>

<script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var clockElement = document.getElementById('clock');
        clockElement.textContent = hours + ':' + minutes + ':' + seconds;
    }

    setInterval(updateClock, 1000);

    updateClock();
</script>

</body>
</html>
