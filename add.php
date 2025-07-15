<?php
// Includi funzioni e sessione
// Se il form è stato inviato (POST):
//   - carica eventi
//   - crea nuovo evento con id, titolo, data, descrizione
//   - salva eventi
//   - incrementa operazioni e imposta messaggio flash
//   - reindirizza a index
// Altrimenti mostra il form

require 'views/form.php';
require 'includes/functions.php';
$aggiunta = salvaEventi('data/events.json');

?>
