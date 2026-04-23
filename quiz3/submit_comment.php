<?php
declare(strict_types=1);

header('Content-Type: application/json');

require __DIR__ . '/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Only POST requests are allowed.'
    ]);
    exit;
}

$visitorName = isset($_POST['visitorName']) ? trim((string) $_POST['visitorName']) : '';
$email = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
$commentText = isset($_POST['commentText']) ? trim((string) $_POST['commentText']) : '';

if ($visitorName === '' || $email === '' || $commentText === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Please complete every field before submitting.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address.'
    ]);
    exit;
}

$insert = $conn->prepare(
    'INSERT INTO quiz3_comments (visitor_name, email, comment_text) VALUES (?, ?, ?)'
);

if (!$insert) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'The server could not prepare the database request.'
    ]);
    exit;
}

$insert->bind_param('sss', $visitorName, $email, $commentText);

if (!$insert->execute()) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'The comment could not be saved right now.'
    ]);
    $insert->close();
    $conn->close();
    exit;
}

$createdAt = date('Y-m-d H:i:s');
$html = sprintf(
    '<article class="comment-card"><header><strong>%s</strong><time>%s</time></header><p>%s</p></article>',
    htmlspecialchars($visitorName, ENT_QUOTES, 'UTF-8'),
    htmlspecialchars($createdAt, ENT_QUOTES, 'UTF-8'),
    nl2br(htmlspecialchars($commentText, ENT_QUOTES, 'UTF-8'))
);

echo json_encode([
    'success' => true,
    'message' => 'Thanks. Your comment was posted successfully.',
    'commentHtml' => $html
]);

$insert->close();
$conn->close();
