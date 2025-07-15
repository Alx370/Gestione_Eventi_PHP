<?php 
// Crea un form HTML per:
// - titolo (text, required)
// - data (date, required)
// - descrizione (textarea, required)
// Il form viene usato sia per aggiunta che modifica
require 'includes/header.php';

$title = isset($evento['title']) ? htmlspecialchars($evento['title']) : '';
$date = isset($evento['date']) ? htmlspecialchars($evento['date']) : '';
$description = isset($evento['description']) ? htmlspecialchars($evento['description']) : '';
?>

<form method="POST" action="">
    <label for="title">Titolo:</label>
    <input type="text" id="title" name="title" required value="<?= $title ?>"><br>

    <label for="date">Data:</label>
    <input type="date" id="date" name="date" required value="<?= $date ?>"><br>

    <label for="description">Descrizione:</label>
    <textarea id="description" name="description" required><?= $description ?></textarea><br>

    <button type="submit"> Aggiungi/Aggiorna Evento</button>
</form>

<?php
require_once 'includes/footer.php';
?>





