<?php

use Eleme\EasyCaptcha\Phrase\Factory as PhraseFactory;
use Eleme\EasyCaptcha\Factory;

require __DIR__.'/../vendor/autoload.php';
header('Content-Type: image/jpeg');
$factory = new Factory();
$phrase = new PhraseFactory();
$factory->render($phrase->build());
