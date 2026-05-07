const form = document.querySelector('form'); // Or use ID: 
document.getElementById('registerForm') 
 
form.addEventListener('submit', (e) => { 
    // Prevent the form from submitting automatically 
    e.preventDefault(); 
 
    // Get values from fields 
    const username = document.getElementById('username').value.trim(); 
    const email = document.getElementById('email').value.trim(); 
    const password = document.getElementById('password').value.trim(); 
    const phone = document.getElementById('phone').value.trim(); 
    const address = document.getElementById('address').value.trim(); 
 
    // 1. Username Validation (Minimum 3 characters) 
    if (username.length < 3) { 
        alert("Username must be at least 3 characters long."); 
        return; 
    } 
 
    // 2. Email Validation (Regex pattern) 
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    if (!emailPattern.test(email)) { 
        alert("Please enter a valid email address."); 
        return; 
    } 
 
    // 3. Password Validation (Minimum 6 characters) 
    if (password.length < 6) { 
        alert("Password must be at least 6 characters long."); 
        return; 
    } 
 
    // 4. Phone Validation (Basic 10-digit check) 
    const phonePattern = /^[0-9]{10}$/;  
    if (!phonePattern.test(phone)) { 
        alert("Please enter a valid 10-digit phone number."); 
        return; 
    } 
 
    // 5. Address Validation 
    if (address === "") { 
        alert("Address field cannot be empty."); 
        return; 
    } 
 
    // If all checks pass 
    alert("Form submitted successfully!"); 
form.submit(); 
});