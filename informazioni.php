<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information - Project Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background color */
            color: #fff; /* Text color */
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        .info-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f1f; /* Container background color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            margin: 10px 0;
            color: #ccc; /* Paragraph text color */
        }

        a {
            color: #55acee; /* Link text color (blue) */
        }

        a:hover {
            color: #2795e9; /* Link text color on hover (darker blue) */
        }

        .return-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #4caf50; /* Button background color (green) */
            color: #fff; /* Button text color (white) */
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .return-button:hover {
            background-color: #45a049; /* Button background color on hover (darker green) */
        }

        .hidden-message {
            color: #333; /* Dark gray color for hidden message */
            font-size: 12px; /* Smaller font size */
            opacity: 0.5; /* Lower opacity for less visibility */
        }
    </style>
</head>
<body>

<div class="info-container">
    <h2 id="info-heading" style="color: green">INFORMAZIONI</h2>
    <p>Programmed by Andrea Caneschi</p>
    <p>Personal Email: <a href="mailto:andrea.caneschi11@gmail.com">andrea.caneschi11@gmail.com</a></p>
    <p>School Email: <a href="mailto:caneschi.andrea@itismeucci.com">caneschi.andrea@itismeucci.com</a></p>
    <p>Instagram Profile: <a href="https://www.instagram.com/andrea.caneschi?igsh=MXdoNmpqMWFsYzN1YQ==" target="_blank">andrea.caneschi</a></p>
    <p>YouTube Channel: <a href="https://www.youtube.com/@andre1105--" target="_blank">@andre1105--</a></p>
    <a href="scelta.php" class="return-button">TORNA A SCELTA</a>
    <p class="hidden-message">Questa pagina nasconde un tesoro. Se lo trovi, meriti una moneta d'oro!</p>
    <p class="hidden-message">Indizio!! Qualcosa deve essere cliccato ripetutamente.</p>
</div>

<script>
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
