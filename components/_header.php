<?php
// Tjek om session allerede er startet så den ikke startes to gange
// session_status() === PHP_SESSION_NONE betyder at ingen session er aktiv
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link til CSS fil -->
    <link rel="stylesheet" href="/static/app.css">

    <!-- Link til Leaflet CSS (Kort bibliotek) -->
    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />


    <!-- Link til JavaScript filer -->
    <script src="/static/app.js" defer></script>
    <script src="/static/mixhtml.js" defer></script>
    
    <!-- Titel på siden -->
    <title>
        <?php echo $title ?? 'MessBolig' ?>
    </title>
</head>
<body>
    <nav>
        <a href="/" class="logo">MessBolig</a>

        <div class="nav-right">
        <?php if (!empty($_SESSION['user_pk'])): ?>
        <!-- Er logget ind: vis log ud knap -->
        <a href="/apis/api-logout.php" class="btn-login">Log ud</a>

        <?php else: ?>
        <!-- Ikke logget ind: vis login knap --> <!-- Tilføj 'active' hvis vi er på login siden -->
        <a href="/login" class="btn-login<?php echo ($active ?? '') === 'login' ? ' active' : ''; ?>">Log ind</a>        
        <?php endif; ?>
        </div>

    </nav>


    

    <!-- 
    Kan også skrive det sådan:
    <a href="/login" class="btn-login<?= $active ?? '' === 'login' ? ' active' : ''; ?>">Login</a>
    -->
