<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            color: #555;
            font-weight: bold;
        }
          .input-group {
        position: relative;
        margin-bottom: 15px;
    }
    input[type="password"],
    input[type="text"] {
        width: 100%;
        padding: 10px;
        padding-right: 40px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
        .toggle-password {
        position: absolute;
        right: 12px;
        top: 65%; /* Lowered from 50% to 35% */
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        font-size: 20px;
        line-height: 1;
    }
        button {
            padding: 10px;
            background-color: #601EF9;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #6387FD;
        }
        ul {
            list-style-type: none;
            padding: 0;
            font-size: 14px;
        }
        .text-danger {
            color: #e74c3c;
        }
        .text-success {
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="<?= base_url('/home/update_password?token=' . $token) ?>" method="POST" onsubmit="return validatePassword()">
            <!-- New Password -->
            <div class="input-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required onkeyup="validatePassword()">
                <i id="togglePassword" class="toggle-password fa-solid fa-eye"></i>
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <i id="toggleConfirmPassword" class="toggle-password fa-solid fa-eye"></i>
            </div>

            <!-- Validation Rules -->
            <ul class="text-start mt-2">
                <li id="lengthCheck" class="text-danger">❌ Minimal 8 karakter</li>
                <li id="uppercaseCheck" class="text-danger">❌ Harus ada huruf besar (A-Z)</li>
                <li id="lowercaseCheck" class="text-danger">❌ Harus ada huruf kecil (a-z)</li>
                <li id="numberCheck" class="text-danger">❌ Harus ada angka (0-9)</li>
                <li id="specialCheck" class="text-danger">❌ Harus ada karakter spesial (!@#$%^&*)</li>
            </ul>

            <button type="submit">Update Password</button>
        </form>
    </div>

    <script>
        // Toggle visibility for New Password
        document.getElementById("togglePassword").addEventListener("click", function() {
            let passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            }
        });

        // Toggle visibility for Confirm Password
        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            let confirmPasswordField = document.getElementById("confirm_password");
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            } else {
                confirmPasswordField.type = "password";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            }
        });

        // Password validation
        function validatePassword() {
            let password = document.getElementById("password").value;

            function updateValidation(elementId, condition, message) {
                let element = document.getElementById(elementId);
                if (condition) {
                    element.innerHTML = "✅ " + message;
                    element.classList.remove("text-danger");
                    element.classList.add("text-success");
                } else {
                    element.innerHTML = "❌ " + message;
                    element.classList.add("text-danger");
                    element.classList.remove("text-success");
                }
            }

            updateValidation("lengthCheck", password.length >= 8, "Minimal 8 karakter");
            updateValidation("uppercaseCheck", /[A-Z]/.test(password), "Harus ada huruf besar (A-Z)");
            updateValidation("lowercaseCheck", /[a-z]/.test(password), "Harus ada huruf kecil (a-z)");
            updateValidation("numberCheck", /[0-9]/.test(password), "Harus ada angka (0-9)");
            updateValidation("specialCheck", /[!@#$%^&*]/.test(password), "Harus ada karakter spesial (!@#$%^&*)");

            return true;
        }
    </script>
</body>
</html>
