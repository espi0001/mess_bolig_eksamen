<?php
// start session (tjek om bruger er logget på)
session_start();
if(isset($_SESSION["user_pk"])){
    header('Location: /');
    exit;
}

$title = "Login - MessBolig";
$active = "login"; // marker login som aktiv i navigationen

require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <h1>Log ind</h1>
        <div id="login-response" class="error-login"></div>

        <form mix-post="/apis/api-login.php" mix-update="#login-response">
            <!-- Email -->
            <input type="email" id="user_email" name="user_email" placeholder="Email">
            <p id="email-error"></p>

            <!-- Password -->
            <input type="password" id="user_password" name="user_password" placeholder="Kodeord">
            <p id="password-error"></p>

            <button type="submit">Log ind</button>
        </form>

        <p class="redirect-link">Har du ikke en konto? <a href="signup">Opret konto</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>
