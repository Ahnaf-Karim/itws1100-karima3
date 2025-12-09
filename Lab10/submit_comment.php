<?php
header('Content-Type: application/json');
include 'db_connect.php';

// Validate required fields
if (
    empty($_POST['visitorName']) ||
    empty($_POST['email']) ||
    empty($_POST['commentText'])
) {
    echo json_encode([
        "success" => false,
        "message" => "All required fields must be filled."
    ]);
    exit;
}

$visitorName = trim($_POST['visitorName']);
$email = trim($_POST['email']);
$commentText = trim($_POST['commentText']);
$featureSuggestion = !empty($_POST['featureSuggestion']) ? trim($_POST['featureSuggestion']) : null;

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid email format."
    ]);
    exit;
}

// Prepared statement
$stmt = $conn->prepare(
    "INSERT INTO siteComments 
    (visitor_name, email, comment_text, feature_suggestion, status)
    VALUES (?, ?, ?, ?, 'approved')"
);

$stmt->bind_param("ssss", 
    $visitorName, 
    $email, 
    $commentText, 
    $featureSuggestion
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Thank you! Your comment has been submitted."
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
