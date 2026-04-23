<?php
declare(strict_types=1);

require __DIR__ . '/db_connect.php';

$comments = [];
$errorMessage = '';

$query = 'SELECT visitor_name, comment_text, created_at FROM quiz3_comments ORDER BY created_at DESC';
$result = $conn->query($query);

if ($result instanceof mysqli_result) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    $result->free();
} else {
    $errorMessage = 'Comments could not be loaded right now.';
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 3 Comment Wall</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-1.4.3.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <main class="page-shell">
        <section class="hero-card">
            <p class="eyebrow">ITWS 1100 Quiz 3</p>
            <h1>Comment Wall</h1>
            <p class="intro">
                Leave a short message and see the newest approved comments appear first.
                This page uses PHP, MySQL, prepared statements, and client-side interactivity.
            </p>
        </section>

        <section class="grid">
            <section class="panel">
                <div class="panel-header">
                    <h2>Leave a Comment</h2>
                    <p>All fields are required for this version.</p>
                </div>

                <div id="form-message" class="message-box" aria-live="polite"></div>

                <form id="commentForm" class="comment-form">
                    <label for="visitorName">Name</label>
                    <input type="text" id="visitorName" name="visitorName" maxlength="80" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" maxlength="120" required>

                    <label for="commentText">Comment</label>
                    <textarea id="commentText" name="commentText" rows="6" maxlength="600" required></textarea>

                    <button type="submit">Post Comment</button>
                </form>
            </section>

            <section class="panel">
                <div class="panel-header">
                    <h2>Newest Comments</h2>
                    <p>Messages are displayed newest-first.</p>
                </div>

                <div id="comments-list" class="comments-list">
                    <?php if ($errorMessage !== ''): ?>
                        <p class="empty-state"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php elseif (count($comments) === 0): ?>
                        <p class="empty-state">No comments yet. Be the first one to post.</p>
                    <?php else: ?>
                        <?php foreach ($comments as $comment): ?>
                            <article class="comment-card">
                                <header>
                                    <strong><?php echo htmlspecialchars($comment['visitor_name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                    <time><?php echo htmlspecialchars($comment['created_at'], ENT_QUOTES, 'UTF-8'); ?></time>
                                </header>
                                <p><?php echo nl2br(htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8')); ?></p>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>
</body>
</html>
