<div class="login-form container">
    <p class="error text-danger" id="response-msg"></p>
    <form class="verify-email register-form flex-column enable" action="/register.php" method="post">
        <div class="form-row d-flex flex-column px-2">
            <label for="fullName">full name</label>
            <input type="text" name="fullName" id="fullName" required>
            <p id="error-fullName" class="text-danger error"></p>
        </div>
        <div class="form-row d-flex flex-column px-2">
            <label for="email">email address</label>
            <input type="email" name="email" id="email">
            <p id="error-email" class="text-danger error"></p>
        </div>
        <div class="form-row d-flex flex-column px-2">
            <label for="password">password</label>
            <input type="password" name="password" id="password">
            <p id="error-password" class="text-danger error"></p>
        </div>
        <div class="form-row d-flex flex-column px-2">
            <label for="confPassword">confirm password</label>
            <input type="password" name="confPassword" id="confPassword">
            <p id="error-confPassword" class="text-danger error"></p>
        </div>
        <div class="form-row d-flex justify-content-center px-2">
            <button type="submit" name="register" class="btn w-100 d-flex justify-content-center align-items-center" id="register-btn">register</button>
        </div>

        <div class="form-row or px-2">
            <p>or</p>
        </div>
        <div class="form-row d-flex px-2">
            <p>already a user ? <a href="/login">login</a> </p>
        </div>
    </form>
</div>