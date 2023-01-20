<?php
//ALS de pagina opgestart wordt
//  Maak verbinding met de database
//  verkrijg GET-data
//  Als dit niet lukt
//      Geef error aan
//      Terug naar homepage
//  Als dit lukt
//      Zet GET-data in eigen array
require_once 'componenten/Info.php';
/** @var $db */
//als de GET info niet is gegeven ga terug naar de homepagina
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
}
//haal de GET-info vanaf homepagina
$id = $_GET['id'];

//Krijg de resultaten van de database
$query = "SELECT * FROM reservations WHERE id = " . $id;
$result = mysqli_query($db, $query);

//Creeer je eigen array door de resultaten heen te gaan
$data = mysqli_fetch_assoc($result);

//sluit de verbinding
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shirley's Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $data ['first_name'] ?> <?= $data ['last_name'] ?></h1>
    <section class="content">
        <ul>
            <li>Soort afspraak: <?= $data ['appointment'] ?></li>
            <li>E-mail: <?= $data['email']?></li>
            <li>Tijdslot: <?= $data ['datetime'] ?></li>
        </ul>
        <a class="button" href="read.php">Go back to the list</a>
    </section>
</div>
</body>
</html>