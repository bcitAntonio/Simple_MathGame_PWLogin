<?php
session_start();
ob_start();
extract($_POST);
$_SESSION["email"] = trim($email);
$_SESSION["password"] = trim($password);

if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
    header("Location:login.php");
}

if (empty($email)) {
    $message = "please enter your email";
    header("Location: login.php?message=$message");
    die();
}

$file = file_get_contents('credentials.config');

function validate()
{
    $pw = file("./credentials.config");
    for ($i = 0; $i < count($pw); $i++) {
        $line = explode(",", $pw[$i]);
        $emailcredentials = $line[0];
        $pwcredentials = $line[1];
        if (trim($_SESSION["email"]) === trim($line[0]) && trim($_SESSION["password"]) === trim($line[1])) {
            return true;
        }
    }

    return false;
}

if (validate()) {
    header("Location:index.php");
}
else {
    $message = "Invalid credential";
    session_unset();
    header("Location: login.php?message=$message");
    die();
}

?>