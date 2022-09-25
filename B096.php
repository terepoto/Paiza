<?php

class BombExplosion
{

    private $width;

    private $height;

    private $bombs;

    private $bombsExplosion;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function setBombs()
    {
        for ($height = 0; $height < $this->height; $height++) {
            $bombs = str_split(str_replace(array(PHP_EOL), '', fgets(STDIN)));
            $this->bombs[$height] = $bombs;
            $this->bombsExplosion[$height] = $bombs;
        }
    }

    public function explosion() {
        foreach ($this->bombs as $y => $yData) {
            foreach ($yData as $x => $bomb) {
                if ($bomb == '#') {
                    for ($explosionX = 0; $explosionX < $this->width; $explosionX++) {
                        $this->bombsExplosion[$y][$explosionX] = '#';
                    }
                    for ($explosionY = 0; $explosionY < $this->height; $explosionY++) {
                        $this->bombsExplosion[$explosionY][$x] = '#';
                    }
                }
            }
        }
    }

    public function explodeRange()
    {
        $count = 0;
        foreach ($this->bombsExplosion as $bombs) {
            foreach ($bombs as $bomb) {
                if ($bomb == '#') {
                    $count++;
                }
            }
        }
        echo $count;
    }
}

$info = explode(" ", str_replace(array(PHP_EOL), '', fgets(STDIN)));
$bombExplosion = new BombExplosion($info[1], $info[0]);
$bombExplosion->setBombs();
$bombExplosion->explosion();
$bombExplosion->explodeRange();
