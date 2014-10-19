<?php
namespace Eleme\EasyCaptcha;

class Factory
{
    private $font = null;
    private $fontfile;

    public function __construct($fontfile = null)
    {
        $this->fontfile = $fontfile ?: __DIR__."/HomBold_16x24.gdf";
    }

    public function render($phrase, $path = null)
    {
        $len = strlen($phrase);
        $image = $this->createImage($this->getFontWidth() * $len, $this->getFontHeight());
        $this->drawBackground($image);
        $this->writePhrase($image, $phrase);
        imagejpeg($image, $path, 90);
    }

    private function drawBackground($image)
    {
        $backgroundColor = $this->getRandColor($image, 200, 255);
        imagefill($image, 0, 0, $backgroundColor);
    }

    private function writePhrase($image, $phrase)
    {
        $font = $this->getFont();
        $textColor = $this->getRandColor($image, 0, 150);
        imagestring($image, $font, 0, 0, $phrase, $textColor);
    }

    private function createImage($width, $height)
    {
        return imagecreatetruecolor($width, $height);
    }

    private function getRandColor($image, $min = 0, $max = 255)
    {
        return imagecolorallocate($image, mt_rand($min, $max), mt_rand($min, $max), mt_rand($min, $max));
    }

    private function getFont()
    {
        return $this->font ?: $this->font = imageloadfont($this->fontfile);
    }

    private function getFontWidth()
    {
        return imagefontwidth($this->getFont());
    }

    private function getFontHeight()
    {
        return imagefontheight($this->getFont());
    }
}
