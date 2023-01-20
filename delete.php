<?php
require_once 'componenten/Info.php';
/** @var $db */

$id = $_GET['id'];
$query = "DELETE FROM reservations WHERE id = '$id'";
$reservations = $db->query($query) or die($db->error);
header("Location:read.php");
?>


