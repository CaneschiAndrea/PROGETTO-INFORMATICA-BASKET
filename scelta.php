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
            padding: 40px 0; /* Modificato il padding per centrare verticalmente */
        }

        /* Aggiunta la regola per centrare orizzontalmente i contenitori principali */
        #header,
        #navbar,
        #content,
        #footer {
            margin: 0 auto;
        }

        /* Rimossi i commenti per le larghezze al 100% in #navbar e #news */
        #navbar,
        #news {
            width: 100%;
        }

        #header {
            background-color: #007bff; /* NBA Blue */
            color: #fff;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: relative; /* Posizione relativa per eventuali contenuti interni */
        }

        #navbar {
            background-color: #222; /* Colore di sfondo della navbar */
            padding: 10px;
            text-align: center;
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .option {
            margin: 10px;
            padding: 12px 20px;
            background-color: #4caf50; /* Colore di sfondo dei pulsanti */
            color: #fff; /* Colore del testo dei pulsanti */
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Transizioni per colore di sfondo e trasformazione */
        }

        .option:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
            transform: scale(1.1); /* Ingrandisce leggermente al passaggio del mouse */
        }

        #news {
            width: 100%;
            max-width: 800px;
            margin: 20px auto; /* Centra le notizie */
            text-align: left; /* Allinea il testo a sinistra */
        }

        .news-item {
            background-color: #222; /* Colore di sfondo delle news */
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
            width: 100%;
        }

        .news-item.active {
            display: block;
        }

        #footer {
            position: fixed;
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

        #footer:hover {
            background-color: #45a049; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        #logout {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: #ff4757; /* Colore di sfondo del pulsante di logout */
            color: #fff; /* Colore del testo del pulsante di logout */
            border-radius: 50%; /* Per rendere il pulsante un cerchio */
            font-size: 18px;
            line-height: 50px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease; /* Effetto di transizione */
        }

        #logout:hover {
            background-color: #e84118; /* Cambia il colore di sfondo al passaggio del mouse */
        }

        h2 {
            margin-top: 0;
            color: #4caf50; /* Colore del titolo */
        }
    </style>
</head>
<body>

<header id="header">
    <h1>Progetto Basket</h1>
</header>

<nav id="navbar">
    <a href="visualizza_dati_atleta.php" class="option">Visualizza dati atleta</a>
    <a href="visualizza_dati_partita.php" class="option">Visualizza dati partita</a>
    <a href="inserisci_partita.php" class="option">Inserisci partita</a>
    <a href="confronta_atleti.php" class="option">Confronta due atleti</a>
    <a href="aggiungi_dati_atleta.php" class="option">Aggiungi dati atleta</a>
    <a href="aggiungi_squadra.php" class="option">Aggiungi squadra</a>
    <a href="calendario.php" class="option">Calendario Partite</a>
</nav>
<br>
<div id="content">
    <h2>Ultime Notizie:</h2>
    <!-- Simulated news -->
    <div id="news">
        <div class="news-item active">
            <h3>LeBron James firma con i Los Angeles Lakers</h3>
            <p>LeBron James ha firmato un contratto quadriennale da 154 milioni di dollari con i Los Angeles Lakers, secondo la sua agenzia, Klutch Sports Group. Questa segna la terza volta nella carriera di LeBron che cambia squadra in free agency.</p>
        </div>
        <div class="news-item">
            <h3>I Golden State Warriors vincono il loro terzo campionato NBA in quattro anni</h3>
            <p>I Golden State Warriors si sono assicurati il ​​terzo campionato NBA in quattro anni dopo aver sconfitto i Cleveland Cavaliers in quattro partite. Kevin Durant è stato nominato MVP delle finali per il secondo anno consecutivo.</p>
        </div>
        <!-- Add more news items -->
    </div>
</div>

<a href="informazioni.php" id="footer">?</a>
<a href="index.php" id="logout">⏻</a>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let currentIndex = 0;
        const items = document.querySelectorAll('.news-item');
        const itemCount = items.length;

        const showNextItem = () => {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % itemCount;
            items[currentIndex].classList.add('active');
        };

        setInterval(showNextItem, 10000); // Cambia notizia ogni 10 secondi
    });
</script>

</body>
</html>
