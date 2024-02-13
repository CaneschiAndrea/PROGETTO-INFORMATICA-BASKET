<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scelta - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px;
        }

        .scelta-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #45a049;
        }

        .logout-button {
            background-color: #f44336;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="scelta-container">
    <h2>Scegli un'opzione</h2>
    <a href="visualizza_dati_atleta.php">Visualizza dati atleta</a>
    <a href="visualizza_dati_partita.php">Visualizza dati partita</a>
    <a href="inserisci_partita.php">Inserisci partita</a>
    <a href="confronta_due_atleti.php">Confronta due atleti</a>

    <a href="aggiungi_dati_atleta.php">Aggiungi dati atleta</a>

    <a href="login.php" class="logout-button">Logout</a>
</div>

</body>
</html>
