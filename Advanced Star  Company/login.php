<?php
 require "db.php";
 session_start();
 if(isset($_POST["login"])){
    $phone = $_POST["user_phoneno"];
    $password = $_POST["user_password"];
    $stmt= $mysqli-> prepare("SELECT user_email,user_password, user_id FROM users WHERE user_phoneno=? and user_password=?");
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $stmt->bind_result($phone,$password,$id);
    $rs=$stmt->fetch();
    $stmt->close();
    $_SESSION['user_id']= $id;
    $_SESSION['$user_phoneno']=$email;
    $uip=$_SERVER['REMOTE_ADDR'];
    $ldate=date('Y-m-d H:i:s',time());
    if($rs){
        $id=$_SESSION['user_id'];
        $email=$_SESSION['login'];
        header('location:homepage.php');
    }else{
        echo "<script>Invalid User Credentials</script>";
    }
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images (2).jpeg" type="x-image icon">
    <title>Login/Signup Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:#0a0a1f;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .tabs {
            display: flex;
            margin-bottom: 2rem;
        }

        .tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            border-bottom: 2px solid #ddd;
        }

        .tab.active {
            border-bottom: 2px solid #1877f2;
            color: #1877f2;
        }

        .form-container form {
            display: none;
        }

        .form-container form.active {
            display: block;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .input-group input:focus {
            border-color: #1877f2;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }

        button:hover {
            background: #166fe5;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('login')">Login</div>
            <div class="tab" onclick="switchTab('signup')">Sign Up</div>
        </div>
        
        <div class="form-container">
            <!-- Login Form -->
            <form id="loginForm" class="active" onsubmit="return handleLogin(event)">
                <div class="input-group">
                    <label for="loginPhone">Phone Number</label>
                    <input type="tel" id="loginPhone" autocomplete="off"  required pattern="[0-9]{10}" placeholder="Enter 10-digit phone number">
                    <div class="error-message" id="loginPhoneError"></div>
                </div>
                <div class="input-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" autocomplete="off" required minlength="6" placeholder="Enter password">
                    <div class="error-message" id="loginPasswordError"></div>
                </div>
                <button type="submit">Login</button>
            </form>

            <!-- Signup Form -->
            <form id="signupForm" onsubmit="return handleSignup(event)">
                <div class="input-group">
                    <label for="signupName">Full Name</label>
                    <input type="text" id="signupName" autocomplete="off"  required placeholder="Enter your full name">
                </div>
                <div class="input-group">
                    <label for="signupPhone">Phone Number</label>
                    <input type="tel" id="signupPhone" autocomplete="off"  required pattern="[0-9]{10}" placeholder="Enter 10-digit phone number">
                    <div class="error-message" id="signupPhoneError"></div>
                </div>
                <div class="input-group">
                    <label for="signupPassword">Password</label>
                    <input type="password" id="signupPassword" autocomplete="off"  required minlength="6" placeholder="Enter password">
                    <div class="error-message" id="signupPasswordError"></div>
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" autocomplete="off"  required minlength="6" placeholder="Confirm password">
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit">Create Account</button>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Update tab styles
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            
            // Show/hide forms
            document.querySelectorAll('form').forEach(form => form.classList.remove('active'));
            if (tab === 'login') {
                document.getElementById('loginForm').classList.add('active');
            } else {
                document.getElementById('signupForm').classList.add('active');
            }
        }

        function handleLogin(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(err => err.style.display = 'none');
            
            const phone = document.getElementById('loginPhone').value;
            const password = document.getElementById('loginPassword').value;
            
            // Basic validation
            if (phone.length !== 10 || !/^\d+$/.test(phone)) {
                const error = document.getElementById('loginPhoneError');
                error.textContent = 'Please enter a valid 10-digit phone number';
                error.style.display = 'block';
                return false;
            }

            // Here you would typically make an API call to verify credentials
            // For demo purposes, we'll just redirect
            window.location.href = 'homepage.php';
            return false;
        }

        function handleSignup(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(err => err.style.display = 'none');
            
            const name = document.getElementById('signupName').value;
            const phone = document.getElementById('signupPhone').value;
            const password = document.getElementById('signupPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;
            
            // Validate phone number
            if (phone.length !== 10 || !/^\d+$/.test(phone)) {
                const error = document.getElementById('signupPhoneError');
                error.textContent = 'Please enter a valid 10-digit phone number';
                error.style.display = 'block';
                return false;
            }
            
            // Validate password match
            if (password !== confirmPass) {
                const error = document.getElementById('confirmPasswordError');
                error.textContent = 'Passwords do not match';
                error.style.display = 'block';
                return false;
            }

            // Here you would typically make an API call to create the account
            // For demo purposes, we'll just redirect
            window.location.href = 'homepage.php';
            return false;
        }
    </script>
</body>
</html>