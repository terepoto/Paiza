<?php
class B019
{
    protected $longOfSide;

    protected $percentage;

    protected $newImage;

    public function __construct()
    {
        $info = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
        $arrInfo = explode(" ", $info);

        $this->longOfSide = $arrInfo[0];
        $this->percentage = $arrInfo[1];
    }

    public function resetImage()
    {
        $newLongOfSide = $this->longOfSide / $this->percentage;
        for ($i = 1; $i <= $newLongOfSide; $i++) {
            $block  = array();

            for ($line = 1; $line <= $this->percentage; $line++) {
                $pixels = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
                $arrPixels  = explode(" ", $pixels);
                foreach ($arrPixels as $number => $value) {
                    $block[$number / $this->percentage][] = $value;
                }
            }

            for ($group = 0; $group < $this->longOfSide / $this->percentage; $group++) {
                $this->newImage[] = floor(array_sum($block[$group]) / $this->percentage / $this->percentage);
            }
        }
    }

    public function display()
    {
        $lineCharge    = 1;
        $newLongOfSide = $this->longOfSide / $this->percentage;

        foreach ($this->newImage as $group => $val) {
            echo $val;

            if ($lineCharge == $newLongOfSide) {
                $lineCharge = 1;
                echo PHP_EOL;
            } else {
                $lineCharge++;
                echo " ";
            }
        }
    }
}

$B019 = new B019;
$B019->resetImage();
$B019->display();