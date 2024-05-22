<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information - Project Basket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212; /* Dark background color */
            color: #fff; /* Text color */
            text-align: center;
            padding: 40px;
            margin: 0;
            opacity: 0; /* Inizialmente impostiamo l'opacità a 0 per l'effetto di fade in */
            transition: opacity 0.5s ease-in-out; /* Transizione di opacità per l'effetto di fade in */
        }

        .info-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Container background color */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50; /* Header color (green) */
            font-size: 28px; /* Larger font size for header */
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
            font-size: 18px; /* Larger font size for paragraphs */
        }

        a {
            color: #007bff; /* Link text color (blue) */
            text-decoration: none;
            transition: color 0.3s ease; /* Smooth transition for link color */
        }

        a:hover {
            color: #0056b3; /* Link text color on hover (darker blue) */
        }

        .return-button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #4CAF50; /* Button background color (green) */
            color: #fff; /* Button text color (white) */
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition for button background color */
        }

        .return-button:hover {
            background-color: #45a049; /* Button background color on hover (darker green) */
        }

        .hidden-message {
            color: #666; /* Dark gray color for hidden message */
            font-size: 14px; /* Smaller font size for hidden message */
            margin-top: 20px;
            opacity: 0.1;
        }
    </style>
</head>
<body>

<div class="info-container">
    <h2 id="info-heading">INFORMAZIONI</h2>
    <p>Programmed by <strong>Andrea Caneschi</strong></p>
    <p>Personal Email: <a href="mailto:andrea.caneschi11@gmail.com">andrea.caneschi11@gmail.com</a></p>
    <p>School Email: <a href="mailto:caneschi.andrea@itismeucci.com">caneschi.andrea@itismeucci.com</a></p>
    <p>Instagram Profile: <a href="https://www.instagram.com/andrea.caneschi?igsh=MXdoNmpqMWFsYzN1YQ==" target="_blank">andrea.caneschi</a></p>
    <p>YouTube Channel: <a href="https://www.youtube.com/@andre1105--" target="_blank">@andre1105--</a></p>
    <p>Threads: <a href="https://www.threads.net/@andrea.caneschi" target="_blank">@andrea.caneschi</a></p>
    <p>GitHUB: <a href="https://github.com/CaneschiAndrea"  target="_blank">CaneschiAndrea</a></p>
    <a href="scelta.php" class="return-button">TORNA A SCELTA</a>
    <p class="hidden-message">Questa pagina nasconde un tesoro. Se lo trovi, meriti una moneta d'oro!</p>
    <p class="hidden-message">Indizio!! Qualcosa deve essere cliccato ripetutamente.</p>
</div>

<script>
    // Una volta che il contenuto della pagina è stato caricato, applichiamo l'effetto di fade in
    document.addEventListener("DOMContentLoaded", function() {
        document.body.style.opacity = 1; // Impostiamo l'opacità a 1 per mostrare il contenuto
    });

    let clickCount = 0;
    const infoHeading = document.getElementById('info-heading');

    infoHeading.addEventListener('click', function() {
        clickCount++;
        if (clickCount === 5) {
            window.location.href = 'easteregg.php';
        }
    });
</script>

</body>
</html>