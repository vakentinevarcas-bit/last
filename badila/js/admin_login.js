const loginForm =
    document.getElementById("loginForm");

const registerForm =
    document.getElementById("registerForm");

const formTitle =
    document.getElementById("formTitle");

const formSubtitle =
    document.getElementById("formSubtitle");

const welcomeTitle =
    document.getElementById("welcomeTitle");

const welcomeText =
    document.getElementById("welcomeText");

const message =
    document.getElementById("message");


function showLogin() {

    loginForm.classList.add("active");
    registerForm.classList.remove("active");

    formTitle.textContent =
        "Admin Login";

    formSubtitle.textContent =
        "Sign in to access your Admin Hub.";

    welcomeTitle.textContent =
        "Admin Portal";

    welcomeText.textContent =
        "Securely manage your system, users, content, and administrative activities from one place.";

    clearMessage();
}


function showRegister() {

    loginForm.classList.remove("active");
    registerForm.classList.add("active");

    formTitle.textContent =
        "Create Admin Account";

    formSubtitle.textContent =
        "Register a new administrator account.";

    welcomeTitle.textContent =
        "Join Admin Hub";

    welcomeText.textContent =
        "Create an administrator account to securely manage your system.";

    clearMessage();
}


function togglePassword(id, button) {

    const input =
        document.getElementById(id);

    if (input.type === "password") {

        input.type = "text";
        button.textContent = "🙈";

    } else {

        input.type = "password";
        button.textContent = "👁";

    }
}


function showMessage(text, type) {

    message.textContent = text;

    message.className =
        "message " + type;
}


function clearMessage() {

    message.textContent = "";

    message.className =
        "message";
}


registerForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const fullname = document.getElementById("registerName").value.trim();
    const username = document.getElementById("registerUsername").value.trim();
    const email = document.getElementById("registerEmail").value.trim();
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        showMessage("Passwords do not match.", "error");
        return;
    }

    showMessage("Saving admin account to database...", "info");

    const formData = new FormData();
    formData.append("action", "register");
    formData.append("fullname", fullname);
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);

    fetch("auth.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                const admin = data.admin || { fullname, username, email };
                localStorage.setItem("adminAccount", JSON.stringify(admin));
                localStorage.setItem("adminFullname", admin.fullname);
                localStorage.setItem("userFullname", admin.fullname);
                localStorage.setItem("adminEmail", admin.email);
                localStorage.setItem("userEmail", admin.email);

                showMessage(data.message || "Admin account created successfully!", "success");
                setTimeout(showLogin, 1200);
            } else {
                showMessage(data.message || "Failed to create admin account.", "error");
            }
        })
        .catch(err => {
            showMessage("Database error: Could not save admin account.", "error");
        });
});

loginForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value;

    showMessage("Authenticating with database...", "info");

    const formData = new FormData();
    formData.append("action", "login");
    formData.append("email", email);
    formData.append("password", password);

    fetch("auth.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                const admin = data.admin || {};
                localStorage.setItem("adminLoggedIn", "true");
                localStorage.setItem("adminFullname", admin.fullname || "Admin");
                localStorage.setItem("userFullname", admin.fullname || "Admin");
                localStorage.setItem("adminEmail", admin.email || email);
                localStorage.setItem("userEmail", admin.email || email);
                if (admin.username) {
                    localStorage.setItem("adminUsername", admin.username);
                }

                showMessage(data.message || "Login successful! Opening Admin Hub...", "success");

                setTimeout(function () {
                    window.location.href = "admin.php";
                }, 800);
            } else {
                showMessage(data.message || "Incorrect admin credentials.", "error");
            }
        })
        .catch(err => {
            showMessage("Database connection error. Please try again.", "error");
        });
});
