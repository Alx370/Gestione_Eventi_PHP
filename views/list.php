<?php
// Includi header e funzioni
// Carica gli eventi e mostra l'elenco in HTML
// Per ogni evento, mostra titolo, data, descrizione
// Aggiungi link a modifica ed elimina

require_once 'includes/functions.php';
$eventi = caricaEventi('data/events.json');
require_once 'includes/header.php';
?>

<body class="container">

    <h1>Eventi</h1>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="welcome-message">
            Benvenuto/a, <?= htmlspecialchars($_SESSION['user']) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <a href="add.php" class="add-event-btn">Aggiungi Nuovo Evento</a>

    <?php if (empty($eventi)): ?>
        <div class="no-events">Nessun evento presente.</div>
    <?php else: ?>
        <ul class="events-list">
        <?php foreach ($eventi as $evento): ?>
            <li class="event-card">
                <h3><?= htmlspecialchars($evento['title']) ?></h3>
                <div class="event-date">
                   Data : <?= htmlspecialchars($evento['date']) ?>
                </div>
                <p class="event-description"><?= htmlspecialchars($evento['description']) ?></p>
                <div class="event-actions">
                    <a href="edit.php?id=<?= $evento['id'] ?>" class="btn btn-edit">Modifica</a>
                    <a href="delete.php?id=<?= $evento['id'] ?>" class="btn btn-delete" onclick="return confirm('Sei sicuro di voler eliminare questo evento?')">Elimina</a>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="operations-counter">
        Operazioni effettuate: <?= isset($_SESSION['operazioni']) ? $_SESSION['operazioni'] : 0 ?>
    </div>

<?php require_once 'includes/footer.php'; ?>
?>