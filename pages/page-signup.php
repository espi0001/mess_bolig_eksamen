<?php
$title = "Opret bruger – MessBolig";
require_once __DIR__."/../components/_header.php";
?>

<main class="page-form">
    <div class="form-box">
        <h1>Opret bruger</h1>
        <div id="signup-response"></div>

        <form mix-post="/apis/api-signup.php" mix-update="#signup-response">
            <input type="email" name="user_email" placeholder="Email" value="tester@gmail.com">
            <input type="text" name="user_username" placeholder="Brugernavn" value="user1234">
            <input type="password" name="user_password" placeholder="Kodeord" value="password">
        
            <button type="submit">Opret bruger</button>
        </form>

        <p>Har du allerede en konto? <a href="login">Log ind</a></p>
    </div>
</main>

<?php require_once __DIR__."/../components/_footer.php"; ?>
