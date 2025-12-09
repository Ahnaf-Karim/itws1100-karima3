<?php
include('includes/init.inc.php');
include('includes/config.inc.php');
include('includes/functions.inc.php');
include('includes/head.inc.php');
?>
<title>Comments - ITWS</title>

<h1>Visitor Comments</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
// Simple feedback area
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'ok') {
        echo '<div class="messages"><h4>Thank you — your comment was received and is pending moderation.</h4></div>';
    } else {
        echo '<div class="messages"><h4>There was a problem submitting your comment.</h4></div>';
    }
}
?>

<h3>Leave a comment</h3>
<form action="comments_process.php" method="post">
    <label for="visitor_name">Name:</label><br />
    <input type="text" name="visitor_name" id="visitor_name" size="60" required /><br />

    <label for="email">Email:</label><br />
    <input type="email" name="email" id="email" size="60" required /><br />

    <label for="comment_text">Comment:</label><br />
    <textarea name="comment_text" id="comment_text" rows="6" cols="60" required></textarea><br />

    <input type="submit" value="Submit" />
</form>

<h3>Approved Comments</h3>
<?php
// Show only approved comments
@$db = new mysqli($GLOBALS['DB_HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']);
if ($db->connect_error) {
    echo '<div class="messages">Could not connect to DB</div>';
} else {
    $stmt = $db->prepare("SELECT visitor_name, comment_text, created_at FROM siteComments WHERE status = 'approved' ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<div class="comment">';
        echo '<h4>' . htmlspecialchars($row['visitor_name']) . ' <small>(' . $row['created_at'] . ')</small></h4>';
        echo '<p>' . nl2br(htmlspecialchars($row['comment_text'])) . '</p>';
        echo '</div>';
    }
    $stmt->close();
    $db->close();
}
?>

<?php include('includes/foot.inc.php'); ?>
