<?php
include('includes/init.inc.php');
include('includes/config.inc.php');
include('includes/functions.inc.php');
include('includes/head.inc.php');
?>
<title>Comments Admin - ITWS</title>

<h1>Comments Administration</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
@$db = new mysqli($GLOBALS['DB_HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']);
if ($db->connect_error) {
    echo '<div class="messages">Could not connect to DB</div>';
} else {
    if (isset($_GET['approve'])) {
        $id = intval($_GET['approve']);
        $u = $db->prepare("UPDATE siteComments SET status='approved' WHERE id = ?");
        $u->bind_param('i', $id);
        $u->execute();
        $u->close();
        echo '<div class="messages"><h4>Comment approved</h4></div>';
    }

    $q = "SELECT id, visitor_name, email, comment_text, created_at, status FROM siteComments ORDER BY created_at DESC";
    $stmt = $db->prepare($q);
    $stmt->execute();
    $res = $stmt->get_result();

    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Comment</th><th>Time</th><th>Status</th><th>Action</th></tr>';
    while ($row = $res->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['visitor_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . nl2br(htmlspecialchars($row['comment_text'])) . '</td>';
        echo '<td>' . $row['created_at'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        if ($row['status'] !== 'approved') {
            echo '<td><a href="comments_admin.php?approve=' . $row['id'] . '">Approve</a></td>';
        } else {
            echo '<td>&nbsp;</td>';
        }
        echo '</tr>';
    }
    echo '</table>';

    $stmt->close();
    $db->close();
}
?>

<?php include('includes/foot.inc.php'); ?>
