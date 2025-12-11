// FILE: js/auth.js
// Simple authentication system using localStorage

const Auth = {
    // Check if user is logged in
    isLoggedIn: function() {
        return localStorage.getItem('resumeLoggedIn') === 'true';
    },
    
    // Login function
    login: function(username, password) {
        // Demo credentials (in real app, this would be server-side)
        if (username === 'admin' && password === 'password123') {
            localStorage.setItem('resumeLoggedIn', 'true');
            localStorage.setItem('resumeUsername', username);
            localStorage.setItem('resumeLastLogin', new Date().toISOString());
            return true;
        }
        return false;
    },
    
    // Logout function
    logout: function() {
        localStorage.removeItem('resumeLoggedIn');
        localStorage.removeItem('resumeUsername');
        window.location.href = 'login.php';
    },
    
    // Protect pages - redirect to login if not authenticated
    protectPage: function() {
        if (!this.isLoggedIn() && window.location.pathname.includes('admin')) {
            window.location.href = 'login.php';
        }
    },
    
    // Get current user
    getCurrentUser: function() {
        return localStorage.getItem('resumeUsername') || 'Admin';
    }
};

// Initialize auth on page load
document.addEventListener('DOMContentLoaded', function() {
    // Handle login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            if (Auth.login(username, password)) {
                window.location.href = 'admin.php';
            } else {
                document.getElementById('errorAlert').style.display = 'block';
            }
        });
    }
    
    // Protect admin pages
    Auth.protectPage();
});