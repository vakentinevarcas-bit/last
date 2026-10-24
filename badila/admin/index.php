<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hub | Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="../css/admin-login-theme.css">
</head>

<body>

    <div class="admin-container">

        <div class="admin-side">

            <div class="logo">
                ADMIN<span>HUB</span>
            </div>

            <div class="admin-icon">
                🛡️
            </div>

            <h1 id="welcomeTitle">
                Admin Portal
            </h1>

            <p id="welcomeText">
                Securely manage your system, users, content, and
                administrative activities from one place.
            </p>

            <div class="security">
                🔒 Secure Administrator Access
            </div>

        </div>


        <div class="form-area">

            <div class="form-header">
                <h2 id="formTitle">
                    Admin Login
                </h2>

                <p id="formSubtitle">
                    Sign in to access your Admin Hub.
                </p>
            </div>


            <div id="message" class="message"></div>


            <form id="loginForm" class="form active">

                <div class="input-group">

                    <label>Admin Gmail</label>

                    <div class="input-wrapper">

                        <span class="icon">✉</span>

                        <input
                            type="email"
                            id="loginEmail"
                            placeholder="admin@gmail.com"
                            required
                        >

                    </div>

                </div>


                <div class="input-group">

                    <label>Password</label>

                    <div class="input-wrapper">

                        <span class="icon">🔒</span>

                        <input
                            type="password"
                            id="loginPassword"
                            placeholder="Enter your password"
                            required
                        >

                        <button
                            type="button"
                            class="show-password"
                            onclick="togglePassword('loginPassword', this)"
                        >
                            👁
                        </button>

                    </div>

                </div>


                <div class="options">

                    <label class="remember">
                        <input type="checkbox">
                        Remember me
                    </label>

                    <a href="#" class="forgot">
                        Forgot Password?
                    </a>

                </div>


                <button type="submit" class="admin-btn">
                    Login to Admin Hub
                </button>


                <div class="switch">
                    Don't have an admin account?
                    <button type="button" onclick="showRegister()">
                        Register
                    </button>
                </div>

            </form>


            <form id="registerForm" class="form">

                <div class="register-grid">

                    <div class="input-group">

                        <label>Full Name</label>

                        <div class="input-wrapper">

                            <span class="icon">👤</span>

                            <input
                                type="text"
                                id="registerName"
                                placeholder="Full name"
                                required
                            >

                        </div>

                    </div>


                    <div class="input-group">

                        <label>Admin Username</label>

                        <div class="input-wrapper">

                            <span class="icon">◎</span>

                            <input
                                type="text"
                                id="registerUsername"
                                placeholder="Username"
                                required
                            >

                        </div>

                    </div>


                    <div class="input-group full">

                        <label>Admin Gmail</label>

                        <div class="input-wrapper">

                            <span class="icon">✉</span>

                            <input
                                type="email"
                                id="registerEmail"
                                placeholder="admin@gmail.com"
                                required
                            >

                        </div>

                    </div>


                    <div class="input-group">

                        <label>Password</label>

                        <div class="input-wrapper">

                            <span class="icon">🔒</span>

                            <input
                                type="password"
                                id="registerPassword"
                                placeholder="Password"
                                minlength="6"
                                required
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword('registerPassword', this)"
                            >
                                👁
                            </button>

                        </div>

                    </div>


                    <div class="input-group">

                        <label>Confirm Password</label>

                        <div class="input-wrapper">

                            <span class="icon">🔐</span>

                            <input
                                type="password"
                                id="confirmPassword"
                                placeholder="Confirm password"
                                minlength="6"
                                required
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword('confirmPassword', this)"
                            >
                                👁
                            </button>

                        </div>

                    </div>

                </div>


                <label class="terms">

                    <input
                        type="checkbox"
                        id="terms"
                        required
                    >

                    <span>
                        I agree to the Admin Hub terms and conditions.
                    </span>

                </label>


                <button type="submit" class="admin-btn">
                    Create Admin Account
                </button>


                <div class="switch">
                    Already have an admin account?
                    <button type="button" onclick="showLogin()">
                        Login
                    </button>
                </div>

            </form>

        </div>

    </div>

    
    <script src="../js/admin_login.js"></script>
</body>
</html>