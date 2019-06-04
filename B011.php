<?php
class B011
{
    private int $capacityOfPocket;

    private int $number;

    private int $backNumber;

    public function __construct()
    {
        $info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrInfo = explode(" ", $info);

        $this->capacityOfPocket = $arrInfo[0];
        $this->number = $arrInfo[1];
    }

    public function getBackNumber() : int
    {
        $position = $this->number % $this->capacityOfPocket;

        if ($position == 0 ) {
            $position = $this->capacityOfPocket;
        }

        $sideOfNumber = $this->getFrontOrBack($this->capacityOfPocket, $this->number);

        switch ($sideOfNumber) {
            case "+":
                $this->backNumber = $this->number + 2 * ($this->capacityOfPocket - $position) + 1;
                break;
            case "-":
                $this->backNumber = $this->number - 2 * ($position - 1) - 1;
                break;
        }

        return $this->backNumber;
    }

    public function getFrontOrBack(int $capacityOfPocket, int $number) : string
    {
        $pocketNum = ceil ( $number / $capacityOfPocket );

        return $pocketNum % 2 == 0 ? "-" : "+";
    }

    public function display() : int
    {
        return $this->backNumber;
    }
}

$B011 = new B011;
$B011->getBackNumber();
echo $B011->display();