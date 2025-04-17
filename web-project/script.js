document.addEventListener('DOMContentLoaded', function() {
    console.log("Script loaded successfully");

const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});
//Get in touch part-----------------------
document.getElementById('contactForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    if (!email.includes('@') || !email.includes('.')) {
        alert('Please enter a valid email address');
        e.preventDefault();
    }
});
//search bar--------------------------------
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchIcon = document.getElementById('searchIcon');
    const tourContainer = document.querySelector('.tour-container');
    const searchStatus = document.getElementById('searchStatus');
    const loadingIndicator = searchStatus.querySelector('.loading-indicator');
    const noResultsMessage = searchStatus.querySelector('.no-results');
    
    // Function to show loading state
    function showLoading() {
        searchStatus.style.display = 'block';
        loadingIndicator.style.display = 'block';
        noResultsMessage.style.display = 'none';
        tourContainer.innerHTML = '';
    }
    
    // Function to show results or no results message
    function showResults(html) {
        loadingIndicator.style.display = 'none';
        
        if (html.trim() === '') {
            noResultsMessage.style.display = 'block';
            tourContainer.innerHTML = '';
        } else {
            noResultsMessage.style.display = 'none';
            tourContainer.innerHTML = html;
        }
    }
    
    // Function to show error
    function showError() {
        loadingIndicator.style.display = 'none';
        noResultsMessage.style.display = 'block';
        noResultsMessage.innerHTML = '<i class="fas fa-exclamation-circle"></i> Error occurred while searching.';
        tourContainer.innerHTML = '';
    }
    
    // Function to perform search
    function performSearch() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        showLoading();
        
        // If search is empty, show all tours
        if (searchTerm === '') {
            fetch('get_tours.php')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(data => {
                    showResults(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError();
                });
            return;
        }
        
        // Send search request to server
        fetch(`search.php?term=${encodeURIComponent(searchTerm)}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(data => {
                showResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                showError();
            });
    }
    
    // Event listeners
    searchIcon.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // Initial load of all tours
    performSearch();
});

});