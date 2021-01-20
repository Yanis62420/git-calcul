<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require __DIR__.'/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__.'/../templates');


$twig = new Environment($loader, [
    'debug' => true,
    'strict_variables' => true,
]);

$twig->addExtension(new DebugExtension());

$formData = [
    'login' => '',
    'password' => '',
];

$errors = [];

if ($_POST) {
    foreach($formData as $key => $value) {
        if(isset($_POST[$key]))
        $formData[$key]=$_POST[$key];
    }
    }

    $minLengthLogin = 3;
    $maxLengthLogin = 190;

    if (empty($_POST['login'])) {
        $errors['login'] = 'Veuillez ne pas laisser ce champ vide';
    } elseif (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 190) {
        $errors['login'] = "Veuillez renseigner un login entre {$minLengthLogin} et {$maxLengthlogin} caractères inclus";
    }

    $minLengthPwd = 8;
    $maxLengthPwd= 32;

    if (empty($_POST['password'])) {
        $errors['password'] = 'Veuillez ne pas laisser ce champ vide';
    } elseif (strlen($_POST['password']) < 3 || strlen($_POST['password']) > 32) {
        $errors['password'] = "Veuillez renseigner entre {$minLengthpwd} et {$maxLengthpwd} caractères inclus";
    } elseif (preg_match('/[Â-Za-Z0-9]/', $_POST['password']) >= 1) {
        $errors['password'] = "Merci de renseigner un mot de passe avec un minimum d'un caractère spécial";
    }

echo $twig->render('login.html.twig', [
    'errors' => $errors,
    'formData' => $formData,
]);