<div class="login-form container">
    <p class="error text-danger" id="response-msg"></p>
    <form class="verify-email register-form flex-column enable" action="/login.php" method="post">
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
        <div class="form-row d-flex justify-content-center px-2">
            <button type="submit" name="login" class="btn w-100 d-flex justify-content-center align-items-center" id="login-btn">login</button>
        </div>

        <div class="form-row or px-2">
            <p>or</p>
        </div>
        <div class="form-row d-flex px-2">
            <p>not registered yet ? <a href="/register.php">register</a> </p>
        </div>
    </form>
</div>