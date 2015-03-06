<?php
namespace Eleme\EasyCaptcha;

class Factory
{
    private $font = null;
    private $fontfile = null;

    public function __construct($fontfile = null)
    {
        $this->fontfile = $fontfile;
    }

    public function render($phrase, $path = null, $fontWidth = 16, $fontHeight = 24)
    {
        $len = strlen($phrase);
        $image = $this->createImage($fontWidth * $len, $fontHeight);
        $this->drawBackground($image);
        $this->writePhrase($image, $phrase, $fontWidth, $fontHeight);
        imagejpeg($image, $path, 90);
    }

    private function drawBackground($image)
    {
        $backgroundColor = $this->getRandColor($image, 200, 255);
        imagefill($image, 0, 0, $backgroundColor);
    }

    private function writePhrase($image, $phrase, $fontWidth, $fontHeight)
    {
        $length = strlen($phrase);
        for ($i = 0; $i < $length; ++$i) {
            $color = $this->getRandColor($image, 0, 150);
            $angle = mt_rand(-10, 10);
            $x = $i * $fontWidth;
            $y = $fontHeight - (int)($fontHeight / 6);
            imagettftext($image, $fontWidth, $angle, $x, $y, $color, $this->getFontfile(), $phrase[$i]);
        }
    }

    private function createImage($width, $height)
    {
        return imagecreatetruecolor($width, $height);
    }

    private function getRandColor($image, $min = 0, $max = 255)
    {
        return imagecolorallocate($image, mt_rand($min, $max), mt_rand($min, $max), mt_rand($min, $max));
    }

    private function getFontfile()
    {
        return $this->fontfile ?: __DIR__."/captcha.ttf";
    }
}
