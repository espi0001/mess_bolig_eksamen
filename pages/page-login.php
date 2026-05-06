<?php
$title = "Login - MessBolig";
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <h1>Login</h1>
        <div id="login-response"></div>

        <input type="email" name="user_email" placeholder="Email">
        <input type="password" name="user_password" placeholder="Password">

        <button mix-post="/../apis/api-login" mix-update="#login-response">Log ind</button>

        <p>Har du ikke en konto? <a href="/pages/page-signup.php">Opret bruger</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>
