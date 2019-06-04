<?php
class B019
{
    private int $longOfSide;

    private int $percentage;

    private array $newImage;

    public function __construct(string $info)
    {
        $info = str_replace(array("\r\n","\r","\n"), '', $info);
        $arrInfo = explode(" ", $info);

        $this->longOfSide = $arrInfo[0];
        $this->percentage = $arrInfo[1];
    }

    public function resetImage() : array
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
        return $this->newImage;
    }

    public function display() : string
    {
        $message       = "";
        $lineCharge    = 1;
        $newLongOfSide = $this->longOfSide / $this->percentage;

        foreach ($this->newImage as $group => $val) {
            $message .= $val;

            if ($lineCharge == $newLongOfSide) {
                $lineCharge = 1;
                $message .= PHP_EOL;
            } else {
                $lineCharge++;
                $message .= " ";
            }
        }

        return $message;
    }
}

$B019 = new B019(trim(fgets(STDIN)));
$B019->resetImage();
echo $B019->display();