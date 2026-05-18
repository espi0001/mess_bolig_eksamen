<?php
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

    <!-- Link til Leaflet CSS -->
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
        <a href="/apis/api-logout.php" class="btn-login">Log ud</a>
        <?php else: ?>
        <a href="/login" class="btn-login<?php echo ($active ?? '') === 'login' ? ' active' : ''; ?>">Login</a>
        <?php endif; ?>
        </div>

    </nav>