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
        title.text(item.a + ': ' + item.b);
        projectDiv.append(title);
        
        
        var img = $('<img>');
        img.attr('src', item.d);
        img.addClass('proj-img');
        projectDiv.append(img);
        
        var link = $('<a></a>');
        link.attr('href', item.c);
        link.text('Click here');
        projectDiv.append(link);
        
        
        container.append(projectDiv);
    }
    
    
    
    $('.project').hide();
    $('.project').fadeIn(1000);
    
    
    $('.project').hover(function() {
        $(this).css('background-color', '#f0f0f0');
    }, function() {
        $(this).css('background-color', 'white');
    });
    
    
    
}