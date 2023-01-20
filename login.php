<?php
session_start();

/** @var mysqli $db */
require_once "componenten/Info.php";

$login = false;
// Is user logged in?
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}



if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "componenten/Info.php";

    // Get form data
    $name = mysqli_escape_string($db, $_POST['name']);
    $password = $_POST['password'];

    // Server-side validation
    $errors = [];
    if ($name == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if ($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }

    // If data valid
    if (empty($errors)) {
        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM accounts WHERE name ='$name'";
        $result = mysqli_query($db, $query);

        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // Get user data from result
            $user = mysqli_fetch_assoc($result);

            // Check if the provided password matches the stored password in the database
            if (password_verify($password, $user['password'])) {
                $login = true;

                // Store the user in the session
                $_SESSION['loggedInUser'] = [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                ];

                $result=mysqli_query($db,$query);
                $row=mysqli_fetch_array($result);


                if($row["usertype"]==="user")
                {

                    $_SESSION["name"]=$name;

                    header("location:index.php");
                }

                else if($row["usertype"]==="admin")
                {

                    $_SESSION["name"]=$name;

                    header("location:read.php");
                }

                // Redirect to secure page
            } else {
                //error incorrect log in
                $errors['loginFailed'] = 'Verkeerd wachtwoord.';
            }
        } else {
            //error incorrect log in
            $errors['loginFailed'] = 'Incorrecte gegevens ingevoerd.';
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Log in</title>
</head>
<body>
<?php require_once 'componenten/header.php'?>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>
            <section class="columns">
                <form class="column is-6" action="" method="post">

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="name">Gebruikersnaam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="name" type="text" name="name" value="<?= $name ?? '' ?>" />
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['name'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="password">Wachtwoord</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                    <?php if(isset($errors['loginFailed'])) { ?>
                                        <div class="notification is-danger">
                                            <button class="delete"></button>
                                            <?=$errors['loginFailed']?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Inloggen</button>
                        </div>
                    </div>

                </form>
            </section>
    </div>
</section>
</body>
</html>

