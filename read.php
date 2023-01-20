<?php
//ALS de pagina opgestart wordt
//  Maak verbinding met de database
//  verkrijg SQL-data
//  Als dit niet lukt
//      Geef error aan
//  Als dit lukt
//      Vraag resultaten van de database
require_once 'componenten/Info.php';
/** @var $db */

//sql data verkrijgen
$query = "SELECT * FROM reservations";
$result = mysqli_query($db,$query)
or die('Error '.mysqli_error($db).'with query'.$query);

//Krijg de resultaten van de database
$reservations= [];
while ($row = mysqli_fetch_assoc($result)){
    $reservations[] = $row;
}

//sluit de verbinding
mysqli_close($db);
?>;

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shirley's Bakery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<?php require_once 'componenten/header.php'?>
<section class="section is-medium">
    <div class="content has-text-centered">
    <h1 class="title">Shirley's Bakery</h1>
    <h2 class="subtitle">
        <table>
            <thead>
            <tr>
                <th>id</th>
                <th>voornaam</th>
                <th>achternaam</th>
                <th>datum en tijd</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $index => $data) { ?>
                <tr>
                    <td><?= $data ['id']?></td>
                    <td><?= $data['first_name']?></td>
                    <td><?= $data['last_name']?></td>
                    <td><?= $data['datetime']?></td>
                    <td><a href="detail.php?id=<?= $data['id']?>"><figure class="image is-24x24"> <img src="pictures/magnifier-1_icon-icons.com_56924.png"> </figure></a></td></a></td>
                    <td><a href="edit.php?id=<?= $data['id']?>"><figure class="image is-24x24"> <img src="pictures/pen.png"> </figure></a></td>
                    <td><a href="delete.php?id=<?= $data['id']?>"><figure class="image is-24x24"> <img src="pictures/delete.png"> </figure></a></td></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </h2>
    </div>
</section>
<?php require_once 'componenten/Footer.php'?>
</body>
</html