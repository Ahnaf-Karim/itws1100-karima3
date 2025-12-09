// AI-assisted: jQuery form validation + AJAX
$(document).ready(function () {

    $("#commentForm").on("submit", function (e) {
        e.preventDefault();

        $("#form-message").removeClass("success error").html("");

        let name = $("#visitorName").val().trim();
        let email = $("#email").val().trim();
        let comment = $("#commentText").val().trim();

        if (name === "") {
            showMessage("Please enter your name.", "error");
            return;
        }

        if (email === "") {
            showMessage("Please enter your email.", "error");
            return;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            showMessage("Invalid email format.", "error");
            return;
        }

        if (comment === "") {
            showMessage("Please enter a comment.", "error");
            return;
        }

        // AJAX Request
        $.ajax({
            url: "submit_comment.php",
            type: "POST",
            data: $("#commentForm").serialize(),
            dataType: "json",

            success: function (response) {
                if (response.success) {
                    showMessage(response.message, "success");
                    $("#commentForm")[0].reset();
                } else {
                    showMessage(response.message, "error");
                }
            },

            error: function () {
                showMessage("Server error. Please try again.", "error");
            }
        });
    });

    function showMessage(msg, type) {
        $("#form-message")
            .html("<p>" + msg + "</p>")
            .addClass(type)
            .fadeIn();
    }
});
