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
        $bg = $this->drawBackground($image);
        $this->writePhrase($image, $phrase, $fontWidth, $fontHeight);
        $this->drawLine($image, $fontWidth * $len, $fontHeight);
        $this->drawLine($image, $fontWidth * $len, $fontHeight);
        $image = $this->distort($image, $fontWidth * $len, $fontHeight, $bg);
        imagejpeg($image, $path, 90);
    }

    private function drawBackground($image)
    {
        $backgroundColor = $this->getRandColor($image, 200, 255);
        imagefill($image, 0, 0, $backgroundColor);
        return $backgroundColor;
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

    private function distort($image, $width, $height, $bg)
    {
        $contents = imagecreatetruecolor($width, $height);
        $X          = mt_rand(0, $width);
        $Y          = mt_rand(0, $height);
        $phase      = mt_rand(0, 10);
        $scale      = 1.1 + mt_rand(0, 10000) / 30000;
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $Vx = $x - $X;
                $Vy = $y - $Y;
                $Vn = sqrt($Vx * $Vx + $Vy * $Vy);

                if ($Vn != 0) {
                    $Vn2 = $Vn + 4 * sin($Vn / 30);
                    $nX  = $X + ($Vx * $Vn2 / $Vn);
                    $nY  = $Y + ($Vy * $Vn2 / $Vn);
                } else {
                    $nX = $X;
                    $nY = $Y;
                }
                $nY = $nY + $scale * sin($phase + $nX * 0.2);

                $p = $this->getCol($image, round($nX), round($nY), $bg);
                imagesetpixel($contents, $x, $y, $p);
            }
        }

        return $contents;
    }

    protected function getCol($image, $x, $y, $background)
    {
        $L = imagesx($image);
        $H = imagesy($image);
        if ($x < 0 || $x >= $L || $y < 0 || $y >= $H) {
            return $background;
        }

        return imagecolorat($image, $x, $y);
    }

    private function drawLine($image, $width, $height)
    {
        $tcol = imagecolorallocate($image, mt_rand(100, 255), mt_rand(100, 255), mt_rand(100, 255));
        $Xa = 0;
        $Ya = mt_rand(0, $height);
        $Xb = $width;
        $Yb = mt_rand(0, $height);
        imagesetthickness($image, mt_rand(1, 3));
        imageline($image, $Xa, $Ya, $Xb, $Yb, $tcol);
    }

    private function getFontfile()
    {
        return $this->fontfile ?: __DIR__."/captcha.ttf";
    }
}
