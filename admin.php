<?php
declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'db.php';
$messages = database()->query('SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages reçus | Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin-page">
    <main class="admin-shell">
        <header class="admin-header">
            <div>
                <p class="eyebrow">Administration <span></span> Portfolio</p>
                <h1>Messages reçus</h1>
            </div>
            <a class="button button-primary" href="index.html">Voir le portfolio <span aria-hidden="true">↗</span></a>
        </header>

        <?php if ($messages === []): ?>
            <section class="admin-empty">
                <h2>Aucun message pour le moment</h2>
                <p>Les messages envoyés depuis le formulaire de contact apparaîtront ici.</p>
            </section>
        <?php else: ?>
            <section class="message-list" aria-label="Liste des messages">
                <?php foreach ($messages as $message): ?>
                    <article class="message-card">
                        <div class="message-meta">
                            <strong><?= htmlspecialchars($message['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                            <time datetime="<?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?>
                            </time>
                        </div>
                        <a href="mailto:<?= htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8') ?>
                        </a>
                        <p><?= nl2br(htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8')) ?></p>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
