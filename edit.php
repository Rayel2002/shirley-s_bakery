<?php
//Require database in this file
/** @var $db */
require_once "componenten/Info.php";
//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: dashboard.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$id = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM reservations WHERE id = " . $id;
$result = mysqli_query($db, $query);

if (isset($_POST['submit'])) {


    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname  = $_POST['first_name'];
    $lastname   = $_POST['last_name'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];

    //Require the form validation handling
    if (empty($errors)) {
        //Require database in this file & image helpers
        require_once "componenten/Info.php";
        /** @var mysqli $db */
        //Save the record to the database
        $query = "UPDATE reservations SET `first_name`='$firstname',`last_name`='$lastname', `email`='$email', `datetime` = '$datetime' WHERE `id`='{$_GET['id']}'";
        $result = mysqli_query($db, $query)or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: read.php?id=' . $_GET["id"]);
        exit;
    }
}


//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$reservations = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Update reserveren</title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Afspraak wijzigen</h1>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Naam</label>
                </div>
                <div class="field-body">
                    <input class="input" id="first_name" type="text" name="first_name" value="<?= $reservations['first_name'] ?? '' ?>"/>
                </div>

            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="lastname">Achternaam</label>
                </div>
                <div class="field-body">
                    <input class="input" id="last_name" type="text" name="last_name" value="<?= $reservations['last_name'] ?? '' ?>"/>
                </div>

            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">Email</label>
                </div>
                <div class="field-body">
                    <input class="input" id="email" type="email" name="email" value="<?= $reservations['email'] ?? '' ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="phone">Tijd</label>
                </div>
                <div class="field-body">
                    <input class="input" id="datetime" type="datetime-local" name="datetime" value="<?= $reservations['datetime'] ?? '' ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Opslaan</button>
                </div>
            </div>
        </form>
    </section>
    <a class="button mt-4" href="read.php">&laquo; Terug naar dashboard</a>
</div>
</body>
</html>
