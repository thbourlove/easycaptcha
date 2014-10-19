<?php
namespace Eleme\EasyCaptcha\Provider\Silex;

use Silex\ServiceProviderInterface;
use Silex\Application;
use Eleme\EasyCaptcha\Factory;
use Eleme\EasyCaptcha\Phrase\Factory as PhraseFactory;

class EasyCaptchaServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['captcha'] = $app->share(
            function (Application $app) {
                return new Factory($app['captcha.fontfile']);
            }
        );
        $app['captcha.fontfile'] = null;

        $app['phrase'] = $app->share(
            function (Application $app) {
                return new PhraseFactory($app['phrase.length'], $app['phrase.charset']);
            }
        );
        $app['phrase.length'] = 4;
        $app['phrase.charset'] = 'abcdefghjkmnpqrstuvwxyz23456789';
    }

    public function boot(Application $app)
    {
    }
}
