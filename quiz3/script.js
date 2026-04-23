$(document).ready(function () {
    $("#commentForm").on("submit", function (event) {
        event.preventDefault();

        var visitorName = $.trim($("#visitorName").val());
        var email = $.trim($("#email").val());
        var commentText = $.trim($("#commentText").val());
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        clearMessage();

        if (visitorName === "") {
            showMessage("Please enter your name.", "error");
            return;
        }

        if (!emailPattern.test(email)) {
            showMessage("Please enter a valid email address.", "error");
            return;
        }

        if (commentText === "") {
            showMessage("Please enter a comment.", "error");
            return;
        }

        $.ajax({
            url: "submit_comment.php",
            type: "POST",
            data: $("#commentForm").serialize(),
            dataType: "json",
            success: function (response) {
                if (!response.success) {
                    showMessage(response.message, "error");
                    return;
                }

                showMessage(response.message, "success");
                $("#commentForm")[0].reset();

                $(".empty-state").remove();
                $("#comments-list").prepend(response.commentHtml);
            },
            error: function () {
                showMessage("The server could not process your comment.", "error");
            }
        });
    });

    function showMessage(message, type) {
        $("#form-message")
            .removeClass("success error")
            .addClass(type)
            .html("<p>" + message + "</p>")
            .fadeIn(150);
    }

    function clearMessage() {
        $("#form-message")
            .removeClass("success error")
            .empty()
            .hide();
    }
});
