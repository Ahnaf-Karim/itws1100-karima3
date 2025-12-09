<?php
// AI-assisted: Database connection and comment retrieval
$servername = "localhost";
$username = "root";  // Change to your database username
$password = "your_password";  // Change to your database password
$dbname = "mySite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch approved comments
$sql = "SELECT visitor_name, comment_text, feature_suggestion, timestamp 
        FROM siteComments 
        WHERE status = 'approved' 
        ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 10 - My Projects</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Lab 10 - My Projects</h1>
    </header>

    <nav>
        <a href="../../index.html">Home</a>
    </nav>

    <div class="container">
        <section class="content">
            <h2>Projects</h2>
            <div class="placeholder">
                <p>Future projects will go here</p>
            </div>
        </section>

        <!-- Comments Display Section -->
        <section class="comments-section">
            <h2>Visitor Comments</h2>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="comments-list">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="comment-card">
                            <div class="comment-header">
                                <strong><?php echo htmlspecialchars($row['visitor_name']); ?></strong>
                                <span class="comment-date"><?php echo date('F j, Y g:i A', strtotime($row['timestamp'])); ?></span>
                            </div>
                            <p class="comment-text"><?php echo nl2br(htmlspecialchars($row['comment_text'])); ?></p>
                            <?php if (!empty($row['feature_suggestion'])): ?>
                                <p class="feature-suggestion">
                                    <strong>Feature Suggestion:</strong> 
                                    <?php echo nl2br(htmlspecialchars($row['feature_suggestion'])); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="no-comments">No comments yet. Be the first to leave a comment!</p>
            <?php endif; ?>
        </section>

        <!-- Comment Submission Form -->
        <section class="comment-form-section">
            <h2>Leave a Comment</h2>
            
            <div id="form-message"></div>
            
            <form id="commentForm" action="submit_comment.php" method="POST">
                <div class="form-group">
                    <label for="name">Name: <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email: <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="comment">Comment: <span class="required">*</span></label>
                    <textarea id="comment" name="comment" rows="5" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="feature">Feature Suggestion (optional):</label>
                    <textarea id="feature" name="feature" rows="3"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Submit Comment</button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 ITWS1100 - Lab 10 | Karima</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>