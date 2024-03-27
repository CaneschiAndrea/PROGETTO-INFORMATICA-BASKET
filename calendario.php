<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario - Progetto Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222; /* Colore di sfondo scuro */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 40px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #555; /* Colore del bordo */
        }

        th {
            background-color: #333; /* Colore di sfondo dell'intestazione */
        }

        td {
            background-color: #444; /* Colore di sfondo del corpo della tabella */
            cursor: pointer;
            position: relative;
        }

        td.current-day {
            background-color: #4caf50; /* Colore di sfondo del giorno corrente */
            color: #fff; /* Colore del testo del giorno corrente */
        }

        form {
            margin-top: 5px;
            position: absolute;
            bottom: 5px;
            left: 5px;
            right: 5px;
            display: none;
        }

        td:hover form {
            display: block;
        }

        input[type="text"], input[type="submit"] {
            padding: 8px;
            font-size: 16px;
            background-color: #555; /* Colore di sfondo dell'input */
            color: #fff; /* Colore del testo dell'input */
            border: none;
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #4caf50; /* Colore di sfondo del pulsante */
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
        }
    </style>
</head>
<body>

<h2>Calendario</h2>

<?php
// Ottieni la data corrente
$currentDate = date('Y-m-d');
$currentDay = date('d');
$currentMonth = date('m');
$currentYear = date('Y');

// Calcola il numero di giorni nel mese corrente
$numDays = date('t', strtotime($currentYear . '-' . $currentMonth . '-01'));

// Calcola il giorno della settimana del primo giorno del mese
$firstDayOfWeek = date('N', strtotime($currentYear . '-' . $currentMonth . '-01'));

// Costruisci il calendario
echo '<table>';
echo '<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Gio</th><th>Ven</th><th>Sab</th><th>Dom</th></tr>';
echo '<tr>';

// Aggiungi celle vuote fino al primo giorno del mese
for ($i = 1; $i < $firstDayOfWeek; $i++) {
    echo '<td></td>';
}

$dayOfMonth = 1; // Giorno del mese
$month = str_pad($currentMonth, 2, '0', STR_PAD_LEFT); // Formato a due cifre per il mese

// Ciclo attraverso i giorni del mese
while ($dayOfMonth <= $numDays) {
    for ($i = $firstDayOfWeek; $i <= 7; $i++) {
        if ($dayOfMonth > $numDays) {
            break;
        }

        // Verifica se il giorno corrente è il giorno corrente
        $class = '';
        if ($currentYear == date('Y') && $currentMonth == date('m') && $dayOfMonth == date('d')) {
            $class = 'class="current-day"';
        }

        // Stampa il giorno con un form per aggiungere un evento
        echo '<td ' . $class . '>' . $dayOfMonth . '<br>';
        echo '<form method="POST" action="">';
        echo '<input type="hidden" name="date" value="' . $currentYear . '-' . $month . '-' . str_pad($dayOfMonth, 2, '0', STR_PAD_LEFT) . '">';
        echo '<input type="text" name="event" placeholder="Aggiungi un evento">';
        echo '<input type="submit" name="submit" value="+">';
        echo '</form>';

        // Se è stato inviato un evento, stampa il messaggio sotto la data corrispondente
        if(isset($_POST['submit']) && $_POST['date'] == $currentYear . '-' . $month . '-' . str_pad($dayOfMonth, 2, '0', STR_PAD_LEFT)) {
            $event = $_POST['event'];
            echo '<p style="color: #aaa; font-size: 12px;">Evento aggiunto: ' . $event . '</p>';
        }

        echo '</td>';

        $dayOfMonth++;
    }

    echo '</tr>';

    // Inizializza il giorno della settimana per la riga successiva
    $firstDayOfWeek = 1;
}

echo '</table>';
?>
<br>
<a href="scelta.php" class="back-button">Torna a Scelta</a>
</body>
</html>
