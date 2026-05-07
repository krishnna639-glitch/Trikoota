/* ============================= 
   COMMON VALIDATION FUNCTIONS 
============================= */ 
 
function isEmpty(value) { 
    return value.trim() === ""; 
} 
 
function isEmail(email) { 
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    return pattern.test(email); 
} 
 
function isPasswordStrong(password) { 
    return password.length >= 6; 
} 
 
/* ============================= 
   LOGIN VALIDATION 
============================= */ 
function validateLogin() { 
    let username = document.getElementById("loginEmail").value; 
    let password = document.getElementById("loginPassword").value; 
 
    if (isEmpty(username)) { 
        alert("username is required"); 
        return false; 
    } 
 
    if (!isEmail(username)) { 
        alert("Enter valid username"); 
        return false; 
    } 
 
    if (isEmpty(password)) { 
        alert("Password is required"); 
        return false; 
    } 
 
    return true; 
} 
 
/* ============================= 
   REGISTER VALIDATION 
============================= */ 
function validateRegister() { 
    let name = document.getElementById("regName").value; 
    let email = document.getElementById("regEmail").value; 
    let password = document.getElementById("regPassword").value; 
    let confirm = document.getElementById("regConfirm").value; 
 
    if (isEmpty(name)) { 
        alert("Name is required"); 
        return false; 
    } 
 
    if (!isEmail(email)) { 
        alert("Enter valid email"); 
        return false; 
    } 
 
    if (!isPasswordStrong(password)) { 
        alert("Password must be at least 6 characters"); 
        return false; 
    } 
 
    if (password !== confirm) { 
        alert("Passwords do not match"); 
        return false; 
    } 
 
    return true;
}