<?php
// AI-assisted: Secure form processing with prepared statements
include 'db_connect.php';

// Initialize response
$response = array('success' => false, 'message' => '');

// Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Server-side validation
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $feature = trim($_POST['feature'] ?? '');
    
    // Validate required fields
    if (empty($name)) {
        $response['message'] = "Name is required.";
        echo json_encode($response);
        exit;
    }
    
    if (empty($email)) {
        $response['message'] = "Email is required.";
        echo json_encode($response);
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format.";
        echo json_encode($response);
        exit;
    }
    
    if (empty($comment)) {
        $response['message'] = "Comment is required.";
        echo json_encode($response);
        exit;
    }
    
    // AI-assisted: Prepared statement for security
    $sql = "INSERT INTO siteComments (visitor_name, email, comment_text, feature_suggestion, status) 
            VALUES (?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $response['message'] = "Error preparing statement: " . $conn->error;
        echo json_encode($response);
        exit;
    }
    
    // Bind parameters (s = string)
    $stmt->bind_param("ssss", $name, $email, $comment, $feature);
    
    // Execute statement
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Thank you! Your comment has been submitted and is pending approval.";
    } else {
        $response['message'] = "Error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>