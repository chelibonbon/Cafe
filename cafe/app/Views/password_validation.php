form action="<?=base_url('home/aksi_register')?>" method="POST" onsubmit="return validatePassword()">
     
            <!-- Password Input -->
  <!-- Password Input -->
<div class="form-outline mb-3 position-relative">
    <label class="form-label w-100" for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" required onkeyup="validatePassword()"/>
    <span id="togglePassword" class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;">
        👁️
    </span>
    <ul class="text-start mt-2" style="list-style-type: none; padding: 0;">
        <li id="lengthCheck" class="text-danger">❌ Minimal 8 karakter</li>
        <li id="uppercaseCheck" class="text-danger">❌ Harus ada huruf besar (A-Z)</li>
        <li id="lowercaseCheck" class="text-danger">❌ Harus ada huruf kecil (a-z)</li>
        <li id="numberCheck" class="text-danger">❌ Harus ada angka (0-9)</li>
        <li id="specialCheck" class="text-danger">❌ Harus ada karakter spesial (!@#$%^&*)</li>
    </ul>
</div>

            <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" id="terms" required />
                <label class="form-check-label" for="terms">
                    I agree to all statements in <a href="#" class="text-primary"><u>Terms of Service</u></a>
                </label>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Register</button>

            <p class="text-center text-muted mt-4">
                Already have an account? <a href="<?=base_url('home/Login')?>" class="fw-bold text-primary"><u>Login here</u></a>
            </p>
        </form>
    </div>


<script>
document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.innerHTML = "🙈"; // Ubah icon jadi mata tertutup
    } else {
        passwordField.type = "password";
        this.innerHTML = "👁️"; // Ubah icon jadi mata terbuka
    }
});

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
}
</script>