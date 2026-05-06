<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link til CSS fil -->
    <link rel="stylesheet" href="../static/app.css">

    <!-- Link til Leaflet CSS -->
    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />


    <!-- Link til JavaScript filer -->
    <script src="../static/app.js"></script>
    <script src="../static/mixhtml.js"></script>
    
    <!-- Titel på siden -->
    <title>
        <?php echo $title ?? 'MessBolig' ?>
    </title>
</head>
<body>
    <!--
    You can do this:
        if( $active == "index" ){ echo "active" }
    Or: 
        $active == "index" ? "active" : ""

    -->
    <nav>
        <a href="/" class="logo">MessBolig</a>

        <div class="nav-right">
        <!-- <button mix-get="api-get-items">Hent boliger</button> -->
        <a href="/login" class="btn-login">Login</a>
        </div>

    </nav>