<?php
include('includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: comments.php?status=error');
    exit;
}

// Start session for flash messages
if (session_status() === PHP_SESSION_NONE) session_start();

$visitor_name = isset($_POST['visitor_name']) ? trim($_POST['visitor_name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';

$_SESSION['form_old'] = [
    'visitor_name' => htmlspecialchars($visitor_name),
    'email' => htmlspecialchars($email),
    'comment_text' => htmlspecialchars($comment_text)
];

$errors = [];
if ($visitor_name === '') $errors[] = 'Name is required.';
if ($email === '') $errors[] = 'Email is required.';
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
if ($comment_text === '') $errors[] = 'Comment text is required.';

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    header('Location: comments.php');
    exit;
}

@$db = new mysqli($GLOBALS['DB_HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']);
if ($db->connect_error) {
    $_SESSION['form_errors'] = ['Could not connect to database.'];
    header('Location: comments.php');
    exit;
}

$ins = "INSERT INTO siteComments (visitor_name, email, comment_text) VALUES (?, ?, ?)";
$stmt = $db->prepare($ins);
if (!$stmt) {
    $_SESSION['form_errors'] = ['Database error (prepare failed).'];
    $db->close();
    header('Location: comments.php');
    exit;
}

$stmt->bind_param('sss', $visitor_name, $email, $comment_text);
$ok = $stmt->execute();
if (!$ok) {
    $_SESSION['form_errors'] = ['Database error (execute failed).'];
    $stmt->close();
    $db->close();
    header('Location: comments.php');
    exit;
}

$stmt->close();
$db->close();

unset($_SESSION['form_old']);
$_SESSION['form_success'] = 'Thank you — your comment was submitted and is pending moderation.';
header('Location: comments.php');
exit;
?>
