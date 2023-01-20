<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($first_name === "") {
    $errors['first_name'] = 'Voornaam mag niet leeg zijn';
}
if ($last_name === "") {
    $errors['name'] = 'Achternaam mag niet leeg zijn';
}
if ($email === "") {
    $errors['email'] = 'E-mail mag niet leeg zijn';
}
if ($datetime === "") {
    $errors['datetime'] = 'Datum mag niet leeg zijn';
}
