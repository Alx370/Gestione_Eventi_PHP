<?php
// Inizializza la sessione
// Memorizza l'utente (da $_GET['user']) e il contatore delle operazioni
// Crea una funzione per incrementare il contatore
// Crea una funzione per i messaggi flash

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Alice';
}

// Inizializza la sessione solo se non già attiva
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['user'])) {
    $_SESSION['user'] = $_GET['user'];
}

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

if (!function_exists('incrementCounter')) {
    function incrementCounter() {
        if (isset($_SESSION['counter'])) {
            $_SESSION['counter']++;
        }
    }
}

if (!function_exists('setFlashMessage')) {
    function setFlashMessage($message) {
        $_SESSION['flash_message'] = $message;
    }
}

if (!function_exists('getFlashMessage')) {
    function getFlashMessage() {
        if (isset($_SESSION['flash_message'])) {
            $msg = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            return $msg;
        }
        return null;
    }
}
?>