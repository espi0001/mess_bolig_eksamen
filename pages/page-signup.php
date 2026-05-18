<?php
$title = "Opret bruger – MessBolig";
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <div id="signup-response"><h1 id="signup-heading">Opret bruger</h1></div>

        <form mix-post="/apis/api-signup.php" mix-update="#signup-response">
            <input type="email" id="user_email" name="user_email" placeholder="Email">
            <p id="email-error"></p>

            <input type="text" id="user_username" name="user_username" placeholder="Brugernavn">
            <p id="username-error"></p>

            <input type="password" id="user_password" name="user_password" placeholder="Kodeord">
            <p id="password-error"></p>

        
            <button type="submit">Opret bruger</button>
        </form>

        <p class="redirect-link">Har du allerede en konto? <a href="login">Log ind</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>