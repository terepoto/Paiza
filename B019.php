<?php
class ResetImage
{
    private int $lengthOfSide;

    private int $percentage;

    private array $newImage;

    public function __construct(string $lengthOfSide, string $percentage)
    {
        $this->lengthOfSide = $lengthOfSide;
        $this->percentage = $percentage;
    }

    public function resetImage() : void
    {
        $purposeLength = $this->lengthOfSide / $this->percentage;
        for ($i = 1; $i <= $purposeLength; $i++) {
            $block  = array();

            for ($line = 1; $line <= $this->percentage; $line++) {
                $pixels = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
                $arrPixels  = explode(" ", $pixels);
                foreach ($arrPixels as $number => $value) {
                    $block[$number / $this->percentage][] = $value;
                }
            }

            for ($group = 0; $group < $this->lengthOfSide / $this->percentage; $group++) {
                $this->newImage[] = floor(array_sum($block[$group]) / $this->percentage / $this->percentage);
            }
        }
        $this->display();
    }

    private function display() : void
    {
        $message       = "";
        $lineCharge    = 1;
        $purposeLength = $this->lengthOfSide / $this->percentage;

        foreach ($this->newImage as $group => $val) {
            $message .= $val;

            if ($lineCharge == $purposeLength) {
                $lineCharge = 1;
                $message .= PHP_EOL;
            } else {
                $lineCharge++;
                $message .= " ";
            }
        }

        echo $message;
    }
}

$info = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
$arrInfo = explode(" ", $info);

$resetImage = new ResetImage($arrInfo[0], $arrInfo[1]);
echo $resetImage->resetImage();