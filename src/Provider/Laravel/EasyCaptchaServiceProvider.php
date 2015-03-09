<?php
namespace Eleme\EasyCaptcha\Provider\Laravel;

use Illuminate\Support\ServiceProvider;
use Eleme\EasyCaptcha\Factory;
use Eleme\EasyCaptcha\Phrase\Factory as PhraseFactory;

class EasyCaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bindShared('captcha', function ($app) {
            return new Factory(null);
        });

        $this->app->bindShared('phrase', function ($app) {
            return new PhraseFactory($app['config']['phrase.length'], $app['config']['phrase.charset']);
        });
    }

    public function provides()
    {
        return array('captcha', 'phrase');
    }
}
