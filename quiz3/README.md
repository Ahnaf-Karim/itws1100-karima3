# Quiz 3 Comment Wall

This project is a guestbook/comment wall built with PHP, MySQL, JavaScript/jQuery, HTML, and CSS.

## Files

- `index.php`: displays the form and the list of comments.
- `submit_comment.php`: validates form input and inserts comments with a prepared statement.
- `db_connect.php`: opens the MySQL connection.
- `script.js`: handles client-side validation and AJAX form submission.
- `style.css`: page styling.
- `schema.sql`: SQL used to create the `quiz3_comments` table.
- `break-it.md`: high-level notes for the security reflection section.

## Database setup

Run the SQL in `schema.sql` inside the `mySite` database:

```sql
CREATE TABLE quiz3_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_name VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## How to test

1. Open `index.php` through your PHP-enabled server.
2. Enter a name, email, and comment.
3. Submit the form.
4. Confirm that the page shows a success message without reloading.
5. Confirm that the new comment appears at the top of the comments list.

## Technical requirements covered

- Includes a MySQL table you designed in `schema.sql`
- Uses PHP server-side logic to read from and write to the database
- Uses a prepared statement in `submit_comment.php`
- Uses client-side interactivity with jQuery/AJAX in `script.js`
- Keeps the project organized inside the `quiz3` folder
