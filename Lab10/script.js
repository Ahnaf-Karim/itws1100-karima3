// Load projects from JSON file
fetch('projects.json')
    .then(response => response.json())
    .then(data => {
        console.log("Projects loaded:", data);
        
    })
    .catch(error => console.error('Error loading projects:', error));

// AI-assisted: jQuery form validation and AJAX submission
$(document).ready(function() {
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous messages
        $('#form-message').html('').removeClass('success error');
        
        // Get form values
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var comment = $('#comment').val().trim();
        
        // Client-side validation
        if (name === '') {
            showMessage('Please enter your name.', 'error');
            return false;
        }
        
        if (email === '') {
            showMessage('Please enter your email.', 'error');
            return false;
        }
        
        // Email format validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showMessage('Please enter a valid email address.', 'error');
            return false;
        }
        
        if (comment === '') {
            showMessage('Please enter a comment.', 'error');
            return false;
        }
        
        // AJAX submission
        $.ajax({
            type: 'POST',
            url: 'submit_comment.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showMessage(response.message, 'success');
                    $('#commentForm')[0].reset(); // Clear form
                } else {
                    showMessage(response.message, 'error');
                }
            },
            error: function() {
                showMessage('An error occurred. Please try again.', 'error');
            }
        });
    });
    
    function showMessage(message, type) {
        $('#form-message')
            .html('<p>' + message + '</p>')
            .addClass(type)
            .show();
    }
});