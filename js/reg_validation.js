alert("Validation Running");
function validateRegisterForm() { 
 
    let username = document.getElementById("username").value.trim(); 
    let email = document.getElementById("email").value.trim(); 
    let password = document.getElementById("password").value.trim(); 
    let phone = document.getElementById("phone").value.trim(); 
    // let address = document.getElementById("address").value.trim(); 
    // let error = document.getElementById("regError").value.trim();
    let error =""; 
 
    // error.innerHTML = ""; 
 
    // All fields mandatory 
    if (username === "" || email === "" || password === "" || phone === "" ) { 
        error = "All fields are mandatory!"; 
        return false; 
    } 
 
    // Username: min 3 alphabets 
    let namePattern = /^[A-Za-z ]{3,}$/; 
    if (!namePattern.test(username)) { 
        error = "Username must contain minimum 3 alphabets!"; 
        // return false; 
    } 

    // Check for uppercase letters in email
    if (email !== email.toLowerCase()) {
        error = "Email must be in lowercase only!";
    }
    // Email validation 
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    if (!emailPattern.test(email)) { 
        error = "Enter a valid email address!"; 
        //return false; 
    } 
 
    // Strong password 
    // At least 6 characters, 1 uppercase, 1 lowercase, 1 number 
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; 
    if (!passwordPattern.test(password)) { 
        error = "Password must be at least 6 characters with uppercase, lowercase & number!"; 
        //return false; 
    } 
 
    // Phone number: exactly 10 digits 
    let phonePattern = /^[0-9]{10}$/; 
    if (!phonePattern.test(phone)) { 
        error = "Phone number must be exactly 10 digits!"; 
        //return false; 
    } 
    if (error != ""){
        alert(error);

        return false;
    }
    else {
        alert("REGISTRATION SUCCESSFUL!");
    }
 
    return true; // allow submit 
}