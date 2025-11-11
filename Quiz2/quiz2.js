alert('The page is about to load');

$(document).ready(function() {
    
    document.title = "Intro to ITWS - Quiz 2";
    
    document.getElementById('goButton').onclick = function() {
        if (document.title === "Intro to ITWS - Quiz 2") {
            document.title = "Ahnaf Karim - Quiz 2";
        } else {
            document.title = "Intro to ITWS - Quiz 2";
        }
    };
    
    $('#studentLastName').mouseenter(function() {
        $(this).addClass('makeItPurple');
    });
    
    $('#studentLastName').mouseleave(function() {
        $(this).removeClass('makeItPurple');
    });
    
});