# Break-It Exercise

This file gives two simple topics to discuss for the break-it portion of the assignment in a safe, high-level way.

## Vulnerability 1: SQL Injection

### What the vulnerable version would change

The unsafe version would replace the prepared statement in `submit_comment.php` with direct string concatenation using user input.

### Why that is dangerous

When user input is mixed directly into SQL, the database may treat part of the input as SQL commands instead of plain text. That can let an attacker change the meaning of the query.

### What could happen

An attacker might bypass intended validation, change inserted data, or potentially interfere with the table depending on the exact query and database permissions.

### Safe fix

The secure version keeps the prepared statement:

```php
$insert = $conn->prepare(
    'INSERT INTO quiz3_comments (visitor_name, email, comment_text) VALUES (?, ?, ?)'
);
$insert->bind_param('sss', $visitorName, $email, $commentText);
```

This prevents the database from treating user input as part of the SQL command.

## Vulnerability 2: Cross-Site Scripting (XSS)

### What the vulnerable version would change

The unsafe version would stop escaping comment output in `index.php` and would print raw user-submitted content directly into the page.

### Why that is dangerous

If a page prints raw user input, a browser may interpret that input as code instead of text. That can affect other visitors viewing the page.

### What could happen

An attacker could inject content that changes the page, runs unwanted browser-side code, or interferes with the experience of other users.

### Safe fix

The secure version escapes output before displaying it:

```php
htmlspecialchars($comment['visitor_name'], ENT_QUOTES, 'UTF-8');
nl2br(htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8'));
```

That keeps the browser treating the submitted content as text instead of executable markup.

## Note

For the class writeup, explain the vulnerable idea, what category of attack it represents, and why the secure code prevents it. Keep any testing limited to a local copy and not a live deployment.
