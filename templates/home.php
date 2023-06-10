<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursy walut</title>
</head>
<body>
<h1>Kursy walut</h1>

<div style="margin-bottom: 10px;">
    <a href="/convert/">Przelicz</a>
    <br>

    <form action="/refresh/" method="post">
        <button type="submit">Pobierz aktualne kursy</button>
    </form>
</div>

<?php require('home/home_list.php') ?>

</body>
</html>