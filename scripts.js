// Handle the "Search" button click
document.getElementById('search-btn').addEventListener('click', function() {
    var searchQuery = document.getElementById('search-input').value;
    alert('Searching for: ' + searchQuery);
    // You can later add AJAX to send the query to the server and display search results
});

// Handle the "Add Art" button click
document.getElementById('add-art-btn').addEventListener('click', function() {
    window.location.href = 'upload_art.html'; // Redirect to a page where users can upload their art
});

// Handle the "Logout" button click
document.getElementById('logout-btn').addEventListener('click', function() {
    // Add logout functionality (clear session, redirect to login, etc.)
    window.location.href = 'login.html'; // Redirect to login page after logging out
});
