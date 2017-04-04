<?php
session_start();
include 'pripojeni.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
        </title>
        <link rel="stylesheet" href="../CSS/css.css">
        <link rel="shortcut icon" href="../foto/favicon.bmp" type="image/x-icon">
    </head>
    <body>
        <div class="barva">
            <?php
            include 'menu.php';
            ?>
            <article>
                <h1>Nízké oprávnění</h1>
                <p>Pro přístup na tuto stránku nemáš oprávnění.</p>
            </article>
            <footer>
            </footer>
        </div>
    </body>
</html>
