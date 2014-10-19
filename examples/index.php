<?php
use Eleme\EasyCaptcha\Factory;

require __DIR__.'/../vendor/autoload.php';
header('Content-Type: image/jpeg');
$factory = new Factory();
$factory->render('asdfghjkl;');
