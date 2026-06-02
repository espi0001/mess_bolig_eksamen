<?php
// start session (tjek om bruger er logget på)
session_start();
if(isset($_SESSION["user_pk"])){
    header('Location: /');
    exit;
}

$title = "Opret bruger - MessBolig";

// DIR - den fulde sti - . er concatination
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <div id="signup-response"><h1 id="signup-heading">Opret bruger</h1></div>

        <form mix-post="/apis/api-signup.php" mix-update="#signup-response">
            <!-- Email -->
            <input type="email" id="user_email" name="user_email" placeholder="Email">
            <p id="email-error"></p>

            <!-- username -->
            <input type="text" id="user_username" name="user_username" placeholder="Brugernavn">
            <p id="username-error"></p>

            <!-- password -->
            <input type="password" id="user_password" name="user_password" placeholder="Kodeord">
            <p id="password-error"></p>

        
            <button type="submit">Opret konto</button>
        </form>

        <p class="redirect-link">Har du allerede en konto? <a href="login">Log ind</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>