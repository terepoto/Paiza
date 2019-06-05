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
            foreach ($lineInfo as $num => $pixels) {
                $block[$lineNumber / $percentage][$num / $percentage] += $pixels;
            }
        }

        foreach ($block as $lineNumber => $lineInfo) {
            foreach ($lineInfo as $num => $pixels) {
                $this->newImage[$lineNumber][$num] = floor($pixels / $percentage / $percentage);
            }
        }

        $this->display();
    }

    public function display() :void
    {
        foreach ($this->newImage as $lineNumber => $lineInfo) {
            foreach ($lineInfo as $num => $pixels) {
                echo $pixels;
                if ($num == count($lineInfo) - 1) {
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