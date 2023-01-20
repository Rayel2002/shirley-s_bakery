<?php
//ALS er op submit gedrukt wordt
//    ALS de data valide is
//        INSERT query opbouwen
//        Query uitvoeren op database
//        ALS correct uitgevoerd
//            Redirect naar index.php
//        NIET correct uit gevoerd
//            Foutmelding tonen
//        DB sluiten
//    Als data niet valide is
//        Formulier tonen
//        Error bericht bij juiste veld
//        Data terugschrijven in form
//Niet op submit gedrukt
//    Leeg formulier tonen


/** @var mysqli $db */

//Kijk of de post aangekomen is
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "componenten/Info.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];

    //Vraag de form validatie aan zodat je niet zomaar gegevens in kan voeren
    require_once "componenten/form_validation.php";

    if (empty($errors)) {
        //Sla de nieuwe gegevens op in de database
        $query = "INSERT INTO reservations (first_name, last_name, email, datetime)
                  VALUES ('$first_name', '$last_name', '$email', '$datetime')";
        echo $query;
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

        //sluit de verbinding
        mysqli_close($db);

        // Terug naar het hoofdmenu
        header('Location: index.php');
        exit;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Shirley's Bakery</title>
</head>
<body>
<?php require_once 'componenten/header.php'?>
<div class="container px-4">
    <h1 class="title mt-4">Maak een afspraak</h1>
    <?php if (!empty($errors)): ?>
        <section class="content">
            <ul class="notification is-danger">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="first_name">Voornaam</label>
                </div>
                <div class="field-body">
                    <input class="input" id="first_name" type="text" name="first_name" value="" required/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="last_name">Achternaam</label>
                </div>
                <div class="field-body">
                    <input class="input" id="last_name" type="text" name="last_name" value="" required/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">E-mail</label>
                </div>
                <div class="field-body">
                    <input class="input" id="email" type="email" name="email" value="" required/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="appointment">Soort afspraak</label>
                </div>
                <div class="field-body">
                    <div class="select">
                        <select>
                            <option>Orienterend gesprek</option>
                            <option>Bestelling</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="datetime">Datum</label>
                </div>
                <div class="field-body">
                    <input class="input" id="datetime" type="datetime-local" name="datetime" value=""/>
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
    <a class="button mt-4" href="index.php">&laquo; Ga terug naar de homepagina</a>
</div>
</body>
</html>
