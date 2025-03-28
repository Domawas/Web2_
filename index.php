<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Csapatok</title>
    <link rel="stylesheet" href="style.css"> <!-- Link a CSS fájlhoz -->
</head>
<body>

    <?php
        require_once 'AB.php';

        $db = new DB();

        // Kommentált kódrészletek
        #$db->csapatBeszur('Farkas', 1, 'farkas.png');
        $db->csapatNevModosit('Királyok', 'Császárok');
        $db->csapatTagokTorlese('Kutya');
        $db->csapatTorlese('Kutya');

        // Csapatok lekérdezése
        $csapatok = $db->csapatokKeppekkel();

        // A csapatok megjelenítése
        echo '<div class="csapat-container">';
        foreach ($csapatok as $csapat) {
            // Minden csapatot egy div-be zárunk
            echo "<div class='csapat'>";
            echo "<h3>" . $csapat['nev'] . "</h3>";
            echo "<img src='forras/" . $csapat['kep'] . "' alt='" . $csapat['nev'] . "'><br><br>";
            echo "</div>";
        }
        echo '</div>';
    ?>

</body>
</html>
