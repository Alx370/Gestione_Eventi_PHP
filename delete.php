<?php
// Includi funzioni e sessione
// Carica eventi, cerca ID da eliminare
// Se trovato, rimuovi evento, salva, incrementa contatore, messaggio flash
// Reindirizza

require 'includes/session.php';
require 'includes/functions.php';
eliminaEvento('data/events.json', $_GET['id'] ?? '');

?>