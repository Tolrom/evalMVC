<?php 
class ViewHeader {
    public function displayView(): string {
        ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supergame</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>Ceci est une barre de navigation</nav>
        </header>
        <main>

    <?php
    $view = ob_get_clean();
    return $view;
    }
}