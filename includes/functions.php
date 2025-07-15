<?php
// Scrivi funzioni per:
// - caricare gli eventi da un file JSON
// - salvare gli eventi su file JSON
// - generare un ID univoco per ogni evento
// - cercare un evento per ID

function caricaEventi($file) {
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $eventi = json_decode($json, true);
        if (is_array($eventi)) {
            return $eventi;
        }
    }
    return [];
}

function salvaEventi($file) {
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Leggi eventi esistenti dal file (se esiste)
    if (file_exists($file)) {
        $eventi = json_decode(file_get_contents($file), true);
        if (!is_array($eventi)) $eventi = [];
    } else {
        $eventi = [];
    }
    
    $nuovo_id = IdUnivoco($eventi);

    // Crea array con i dati
    $evento = [
        'id' => $nuovo_id,
        'title' => $title,
        'date' => $date,
        'description' => $description
    ];

    // Aggiungi nuovo evento
    $eventi[] = $evento;

    // Salva nel file JSON
    file_put_contents($file, json_encode($eventi, JSON_PRETTY_PRINT));
    header('Location: index.php');
   }
    
}

function IdUnivoco($eventi) {
    // Trova l'ultimo ID
    $ultimo_id = 0;
    foreach ($eventi as $e) {
        if (isset($e['id']) && $e['id'] > $ultimo_id) {
            $ultimo_id = $e['id'];
        }
    }
    $nuovo_id = $ultimo_id + 1;
    return $nuovo_id;
}

function modificaEvento($file, $id, $title, $date, $description) {
    if (!isset($_GET['id'])) {
    $_SESSION['error'] = "ID evento mancante";
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

// Leggi eventi dal file
$file = 'data/events.json';
$eventi = [];
if (file_exists($file)) {
    $eventi = json_decode(file_get_contents($file), true);
}

// Trova evento con ID specificato
$evento = null;
foreach ($eventi as $key => $e) {
    if ($e['id'] == $id) {
        $evento = $e;
        break;
    }
}

// Se evento non trovato mostra errore
if (!$evento) {
    $_SESSION['error'] = "Evento non trovato";
    header('Location: index.php');
    exit();
}

// Se form inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aggiorna i dati dell'evento
    $evento['title'] = $_POST['title'];
    $evento['date'] = $_POST['date'];
    $evento['description'] = $_POST['description'];
    
    // Aggiorna l'evento nell'array
    $eventi[$key] = $evento;
    
    // Salva eventi
    file_put_contents($file, json_encode($eventi, JSON_PRETTY_PRINT));
    
    // Incrementa operazioni e imposta messaggio
    $_SESSION['operazioni']++;
    $_SESSION['success'] = "Evento modificato con successo";
    
    // Reindirizza
    header('Location: index.php');
    exit();
}

// Altrimenti mostra il form
include 'views/form.php';
}

function eliminaEvento($file, $id) {
    // Leggi eventi dal file
    $eventi = caricaEventi($file);
    
    // Trova l'evento da eliminare
    foreach ($eventi as $key => $evento) {
        if ($evento['id'] == $id) {
            unset($eventi[$key]);
            break;
        }
    }
    
    // Riscrivi il file senza l'evento eliminato
    file_put_contents($file, json_encode(array_values($eventi), JSON_PRETTY_PRINT));
    
    // Incrementa operazioni e imposta messaggio
    $_SESSION['operazioni']++;
    $_SESSION['success'] = "Evento eliminato con successo";
    
    // Reindirizza alla lista eventi
    header('Location: index.php');
    exit();
}
