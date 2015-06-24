<?php
namespace Eleme\EasyCaptcha\Provider\Laravel;

use Illuminate\Support\Facades\Facade;

class PhraseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'phrase';
    }
}
