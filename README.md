# EasyCaptcha
[![Build Status](https://travis-ci.org/thbourlove/easycaptcha.png?branch=master)](https://travis-ci.org/thbourlove/easycaptcha)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thbourlove/easycaptcha/badges/quality-score.png?s=f113f1ab965f6aaef55e497a330caf72bff94201)](https://scrutinizer-ci.com/g/thbourlove/easycaptcha/)
[![Code Coverage](https://scrutinizer-ci.com/g/thbourlove/easycaptcha/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thbourlove/easycaptcha/?branch=master)
[![Stable Status](https://poser.pugx.org/eleme/easycaptcha/v/stable.png)](https://packagist.org/packages/eleme/easycaptcha)

php captcha lib.

## Install With Composer:

```json
"require": {
    "eleme/easycaptcha": "~0.1"
}
```

## Example
```php
<?php

use Eleme\EasyCaptcha\Phrase\Factory as PhraseFactory;
use Eleme\EasyCaptcha\Factory;

require __DIR__.'/../vendor/autoload.php';
header('Content-Type: image/jpeg');
$factory = new Factory();
$phrase = new PhraseFactory();
$factory->render($phrase->build());
```

## Demo

```sh
git clone http://github.com/thbourlove/easycaptcha
cd easycaptcha
make build
make demo
```
