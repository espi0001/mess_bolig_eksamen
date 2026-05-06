<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/static/app.css">

    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />


    <title>
        <?php echo $title ?? 'Company' ?>
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
        <a href="/" class="<?= $active == 'index' ? 'active' : '' ?>">
            Home
        </a>
        <a href="/contact-us" class="<?= $active == 'contact' ? 'active' : '' ?>">
            Contact us
        </a>
        <a href="/about-us" class="<?= $active == 'about' ? 'active' : '' ?>">
            About us
        </a>
    </nav>