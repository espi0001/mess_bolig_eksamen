<?php
$title = "Opret bruger – MessBolig";
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <h1>Opret bruger</h1>
        <div id="signup-response"></div>

        <input type="email" name="user_email" placeholder="Email">
        <input type="text" name="user_username" placeholder="Brugernavn">
        <input type="password" name="user_password" placeholder="Kodeord">

        <button mix-post="api-sign-up" mix-update="#signup-response">Opret bruger</button>

        <p>Har du allerede en konto? <a href="login">Log ind</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>
