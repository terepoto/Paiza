<?php
class BackNumber
{
    public function getBackNumber($capacityOfPage, $number) : void
    {
        $relativePosition = $number % $capacityOfPage;
        if ($relativePosition == 0) {
            $relativePosition = $capacityOfPage;
        }
        if ($this->checkIfIsInFront($number, $capacityOfPage)) {
            $backNumber = $number + 2 * ($capacityOfPage - $relativePosition) + 1;
        } else {
            $backNumber = $number - 2 * ($relativePosition - 1) - 1;
        }
        echo $backNumber;
    }

    private function checkIfIsInFront($number, $capacityOfPage) : bool
    {
        $page = ceil ( $number / $capacityOfPage );
        if ($page % 2 == 0) {
            return false;
        }
        return true;
    }
}

$info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
$arrInfo = explode(" ", $info);

$capacityOfPage = $arrInfo[0];
$number         = $arrInfo[1];

$backNumber = new BackNumber();
$backNumber->getBackNumber($capacityOfPage, $number);