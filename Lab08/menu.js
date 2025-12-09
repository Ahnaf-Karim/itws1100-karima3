$(document).ready(function() {
    
    $.ajax({
        url: 'projects.json',
        dataType: 'json',
        success: function(data) {
            makeMenu(data);
        },
        error: function() {
            alert('didnt work');
        }
    });
    
});


function makeMenu(data) {
    
    var container = $('#menu');
    
    
    for (var i = 0; i < data.menuItem.length; i++) {
        var item = data.menuItem[i];

        var projectDiv = $('<div></div>');
        projectDiv.addClass('project');

        var title = $('<h3></h3>');
        // use clearer JSON keys: title and subtitle
        title.text(item.title + ': ' + item.subtitle);
        projectDiv.append(title);

        var img = $('<img>');
        img.attr('src', item.image);
        img.addClass('proj-img');
        projectDiv.append(img);
        
        var link = $('<a></a>');
        link.attr('href', item.url);
        link.text('Click here');
        projectDiv.append(link);

        container.append(projectDiv);
    }
    
    
    
    $('.project').hide();
    $('.project').fadeIn(1000);
    
    
    // hover styling moved to CSS (projects.css) to remove inline styles
    
    
    
}