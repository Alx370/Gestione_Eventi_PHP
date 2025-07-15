<?php
// Includi funzioni e sessione
// Carica evento da modificare tramite ID in GET
// Se evento non trovato mostra errore
// Se form inviato:
//   - aggiorna i dati dell'evento
//   - salva eventi, incrementa operazioni, messaggio flash
//   - reindirizza
// Altrimenti mostra il form

// Includi funzioni e sessione
require 'includes/session.php';
require 'includes/functions.php';
$modifica = modificaEvento('data/events.json', $_GET['id'], $_POST['title'] ?? '', $_POST['date'] ?? '', $_POST['description'] ?? '');
?>