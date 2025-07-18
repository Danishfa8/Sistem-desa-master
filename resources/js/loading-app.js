import './bootstrap';

// Loading Bar functionality
document.addEventListener('DOMContentLoaded', function() {
    const loadingBar = document.getElementById('loading-bar');
    
    if (!loadingBar) return;
    
    // Function to show loading bar
    window.showLoading = function() {
        loadingBar.style.width = '70%';
    }
    
    // Function to complete loading bar
    window.completeLoading = function() {
        loadingBar.style.width = '100%';
        setTimeout(() => {
            loadingBar.style.width = '0%';
        }, 500);
    }
    
    // Show loading on page load
    window.addEventListener('load', function() {
        completeLoading();
    });
    
    // Show loading on all link clicks
    document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
        link.addEventListener('click', function(e) {
            // Skip if modifier keys are pressed or it's an anchor link
            if (e.metaKey || e.ctrlKey || link.getAttribute('href')?.startsWith('#') || 
                link.getAttribute('data-no-loading') !== null) {
                return;
            }
            
            showLoading();
        });
    });
    
    // Show loading on all form submissions
    document.querySelectorAll('form:not([data-no-loading])').forEach(form => {
        form.addEventListener('submit', function() {
            showLoading();
        });
    });
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        showLoading();
    });
    
    // Expose functions to window for use in other scripts
    window.showLoadingBar = showLoading;
    window.completeLoadingBar = completeLoading;
});

// Add support for Turbo or other SPA-like navigation if used
document.addEventListener('turbo:click', function() {
    if (window.showLoadingBar) window.showLoadingBar();
});

document.addEventListener('turbo:load', function() {
    if (window.completeLoadingBar) window.completeLoadingBar();
});


