/* Lab 6 - Student jQuery Exercises */
/* ================================= */
/* Complete the 5 problems below by writing jQuery code */
/* Use the framework functions like logToConsole() to help debug */

/* ========================================== */
/* 📋 IMPORTANT: SUBMISSION REQUIREMENTS     */
/* ========================================== */
/* 
/* 🔧 GIT WORKFLOW:
/*    1. Create a new branch: git checkout -b lab6
/*    2. Work on your solutions in this branch
/*    3. Test thoroughly before committing
/*    4. When complete: git add . && git commit -m "Complete Lab 6 jQuery exercises"
/*    5. Switch back to main: git checkout main
/*    6. Merge your work: git merge lab6
/*    7. Push to GitHub: git push origin main
/*
/* 🌐 DEPLOYMENT:
/*    8. Deploy your updated repository to your Azure Web App
/*    9. Verify your lab works correctly on your live site
/*
/* 📁 SUBMISSION TO LMS:
/*    10. Update your README.md file with Lab 6 information
/*    11. Add a link to Lab 6 on your personal website's landing page
/*    12. Create a ZIP file of your entire repository folder
/*    13. Submit the ZIP file to the LMS
/*
/* ⚠️  DON'T FORGET:
/*    - Test your live site before submitting
/*    - Include updated README.md in your repository
/*    - Add Lab 6 link to your website's main navigation/landing page
/*    - Verify all 5 problems work correctly
/*
/* ========================================== */

// jQuery Document Ready - This runs when the page is fully loaded
$(document).ready(function () {

    // Keep a counter for dynamically added list items (start after existing items)
    let listItemCounter = $('#labList li').length || 5;

    // ============================================
    // PROBLEM 1: PERSONAL INFORMATION & STYLING
    // ============================================
    // When the heading is clicked replace the name and apply styles
    $('#nameHeading').click(function() {
        // Target the inner element with class .myName
        $('#nameHeading .myName')
            .text('Ahnaf Karim')
            .css({
                'font-variant': 'small-caps',
                'color': '#ff6b6b',
                'font-size': '200%'
            });

        logToConsole('Name heading clicked - name and styling applied!', 'success');
    });

    // ============================================
    // PROBLEM 2: TEXT ANIMATION
    // ============================================
    $('#hideText').click(function(e) {
        e.preventDefault();
        // Hide the #textContent over 2000ms
        $('#textContent').hide(2000);
        logToConsole('Hide text clicked - hiding text over 2000ms', 'info');
    });

    $('#showText').click(function(e) {
        e.preventDefault();
        // Show the #textContent over 3300ms
        $('#textContent').show(3300);
        logToConsole('Show text clicked - showing text over 3300ms', 'info');
    });

    $('#toggleText').click(function(e) {
        e.preventDefault();
        // Toggle the #textContent visibility over 2000ms
        $('#textContent').toggle(2000);
        logToConsole('Toggle text clicked - toggling text visibility', 'info');
    });

    // ============================================
    // PROBLEM 3: INTERACTIVE LIST ITEMS
    // ============================================
    // Direct event handler for the initially existing list items.
    // (This demonstrates the non-delegated approach. Problem 5 will
    // replace this with a delegated handler so dynamically added items
    // will also work.)
    $('#labList li').click(function() {
        $(this).toggleClass('red');
        const itemText = $(this).text();
        logToConsole(`List item clicked (direct): "${itemText}"`, 'info');
    });

    // ============================================
    // PROBLEM 4: DYNAMIC CONTENT CREATION
    // ============================================
    $('#AddListItem').click(function() {
        // Increment counter and append a new list item
        listItemCounter++;
        const newText = `New item ${listItemCounter} - Click me!`;
        $('#labList').append(`<li>${newText}</li>`);
        logToConsole(`Added list item: ${newText}`, 'success');
    });

    // ============================================
    // PROBLEM 5: EVENT DELEGATION CHALLENGE  
    // ============================================
    // Replace the direct handler from Problem 3 with a delegated one
    // so dynamically added items (via Problem 4) will also respond.
    // First, remove the direct handler attached above, then add a delegated handler.
    $('#labList li').off('click'); // remove direct handler
    $(document).on('click', '#labList li', function() {
        $(this).toggleClass('red');
        const itemText = $(this).text();
        logToConsole(`List item toggled (delegated): "${itemText}"`, 'success');
    });

}); // End of $(document).ready()