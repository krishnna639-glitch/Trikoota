document.addEventListener('DOMContentLoaded', function () { 
    const loginForm = document.getElementById('loginForm'); 
 
    if (loginForm) { 
        loginForm.addEventListener('submit', function (e) { 
            // Get the input elements 
            // const usernameField = document.getElementById('loginUsername'); 
            // const passwordField = document.getElementById('loginPassword'); 
 
            const username = usernameField.value.trim(); 
            const password = passwordField.value.trim(); 
 
            let errors = []; 
 
            // 1. Username length validation (matching registration rules) 
            if (username.length < 3) { 
                errors.push("Username must be at least 3 characters long."); 
            } 
 
            // 2. Password length validation (matching registration rules) 
            if (password.length < 6) { 
                errors.push("Password must be at least 6 characters long."); 
            } 
 
            // If there are errors, stop the form from submitting 
            if (errors.length > 0) { 
                e.preventDefault(); // This stops the PHP from running 
                alert(errors.join("\n")); 
            } 
        }); 
    } 
}); 
