<?php
namespace Eleme\EasyCaptcha\Phrase;

class Factory
{
    private $length;
    private $charset;

    public function __construct($length = 4, $charset = 'abcdefghjkmnpqrstuvwxyz23456789')
    {
        $this->length = $length;
        $this->charset = $charset;
    }

    public function build()
    {
        $phrase = '';
        $len = strlen($this->charset);

        for ($i = 0; $i < $this->length; $i++) {
            $phrase .= $this->charset[mt_rand(0, $len - 1)];
        }

        return $phrase;
    }
}
