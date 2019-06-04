<?php
class ResetImage
{
    private int $imageLength;

    private int $percentage;

    private array $newImage;

    public function __construct(string $imageLength, string $percentage)
    {
        $this->imageLength = $imageLength;
        $this->percentage = $percentage;
    }

    public function resetImage() : void
    {
        $purposeImageLength = $this->imageLength / $this->percentage;
        for ($i = 1; $i <= $purposeImageLength; $i++) {
            $block  = array();

            for ($line = 1; $line <= $this->percentage; $line++) {
                $arrPixels = $this->getPixels();
                foreach ($arrPixels as $number => $value) {
                    $block[$number / $this->percentage][] = $value;
                }
            }

            for ($group = 0; $group < $purposeImageLength; $group++) {
                $this->newImage[] = floor(array_sum($block[$group]) / $this->percentage / $this->percentage);
            }
        }
        $this->display();
    }

    private function getPixels() : array
    {
        $pixels = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
        return $arrPixels  = explode(" ", $pixels);
    }

    private function display() : void
    {
        $message       = "";
        $lineCharge    = 1;
        $purposeImageLength = $this->imageLength / $this->percentage;

        foreach ($this->newImage as $group => $val) {
            $message .= $val;

            if ($lineCharge == $purposeImageLength) {
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
$resetImage->resetImage();