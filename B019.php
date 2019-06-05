<?php
class ResetImage
{
    private  array $image;

    private  array $newImage;

    public function __construct(array $image)
    {
        $this->image = $image;
    }

    public function resetImage(int $percentage) : void
    {
        $block = array();

        foreach ($this->image as $lineNumber => $lineInfo) {
            foreach ($lineInfo as $columnNum => $pixel) {
                $block[$lineNumber / $percentage][$columnNum / $percentage] += $pixel;
            }
        }

        foreach ($block as $lineNumber => $lineInfo) {
            foreach ($lineInfo as $columnNum => $pixel) {
                $this->newImage[$lineNumber][$columnNum] = floor($pixel / pow($percentage, 2));
            }
        }

        $this->display();
    }

    private function display() :void
    {
        foreach ($this->newImage as $lineNumber => $lineInfo) {
            foreach ($lineInfo as $columnNum => $pixel) {
                echo $pixel;
                if ($columnNum == count($lineInfo) - 1) {
                    continue;
                }
                echo " ";
            }
            echo PHP_EOL;
        }
    }
}

$info = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
$arrInfo = explode(" ", $info);

$lengthOfImage = $arrInfo[0];
$percentage    = $arrInfo[1];

$image = array();
for ($num = 0; $num < $lengthOfImage; $num++) {
    $image[] = explode(" ", str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN))));
}

$resetImage = new ResetImage($image);
$resetImage->resetImage($percentage);