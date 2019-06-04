<?php

class B011{

    protected $capacityOfPocket;

    protected $number;

    protected $backNumber;

    public function __construct()
    {
        $info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrInfo = explode(" ", $info);

        $this->capacityOfPocket = $arrInfo[0];
        $this->number = $arrInfo[1];
    }

    public function getBackNumber()
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
    }

    public function getFrontOrBack($capacityOfPocket, $number)
    {
        $pocketNum = ceil ( $number / $capacityOfPocket );

        return $pocketNum % 2 == 0 ? "-" : "+";
    }

    public function display()
    {
        echo $this->backNumber;
    }
}

$B011 = new B011;
$B011->getBackNumber();
$B011->display();