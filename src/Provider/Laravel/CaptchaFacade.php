<?php
namespace Eleme\EasyCaptcha\Provider\Laravel;

use Illuminate\Support\Facades\Facade;

class CaptchaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'captcha';
    }
}

