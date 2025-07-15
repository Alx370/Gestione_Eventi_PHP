<?php
// Includi la vista che mostra l'elenco degli eventi

// Avvia la sessione per gestire i messaggi
session_start();

require 'includes/header.php';
// Includi la vista che mostra l'elenco degli eventi 
include 'views/list.php';

require 'includes/footer.php';
?>