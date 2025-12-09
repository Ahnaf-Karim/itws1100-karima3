<?php
// Include DB connection
include 'db_connect.php';

// Fetch approved comments
$sql = "SELECT visitor_name, email, comment_text, feature_suggestion, timestamp 
        FROM siteComments 
        WHERE status='approved'
        ORDER BY timestamp DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Site - Comments</title>
    <link rel="stylesheet" href="style.css">

    <!-- Step 4: REQUIRED jQuery line -->
    <script src="jquery-1.4.3.min.js"></script>

    <!-- Your AJAX + validation code -->
    <script src="script.js"></script>
</head>

<body>

<h2>Visitor Comments</h2>

<div id="comments-section">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment'>";
            echo "<p><strong>" . htmlspecialchars($row['visitor_name']) . "</strong> – ";
            echo "<em>" . $row['timestamp'] . "</em></p>";
            echo "<p>" . nl2br(htmlspecialchars($row['comment_text'])) . "</p>";

            if (!empty($row['feature_suggestion'])) {
                echo "<p class='suggestion'>Feature Suggestion: " . 
                     htmlspecialchars($row['feature_suggestion']) . "</p>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>No comments yet — be the first!</p>";
    }
    ?>
</div>

<hr>

<h2>Leave a Comment</h2>

<div id="form-message"></div>

<form id="commentForm">

    <label>Name: *</label>
    <input type="text" id="visitorName" name="visitorName" required>

    <label>Email: *</label>
    <input type="email" id="email" name="email" required>

    <label>Comment: *</label>
    <textarea id="commentText" name="commentText" required></textarea>

    <label>Feature Suggestion (optional)</label>
    <input type="text" id="featureSuggestion" name="featureSuggestion">

    <button type="submit">Submit</button>
</form>

</body>
</html>
