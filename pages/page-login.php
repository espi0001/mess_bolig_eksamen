<?php
$title = "Login - MessBolig";
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <h1>Login</h1>
        <div id="login-response"></div>

        <form mix-post="/apis/api-login.php" mix-update="#signup-response">
            <input type="email" name="user_email" placeholder="Email">
            <input type="password" name="user_password" placeholder="Password">
    
            <button type="submit">Log ind</button>
        </form>

        <p>Har du ikke en konto? <a href="signup">Opret bruger</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>
