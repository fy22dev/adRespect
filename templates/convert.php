<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konwersja walut</title>
</head>
<body>
<h1>Konwersja walut</h1>

<div style="margin-bottom: 10px;">
    <a href="/">Home</a>
</div>

<?php require('messages.php') ?>
<?php require('convert/convert_form.php') ?>

<h2>Poprzednie konwersje</h2>
<?php require('convert/convert_list.php') ?>

</body>
</html>