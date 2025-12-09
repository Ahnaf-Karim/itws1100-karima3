
fetch('projects.json')
    .then(response => response.json())
    .then(data => {
        console.log("Projects loaded:", data);
        
    })
    .catch(error => console.error('Error loading projects:', error));