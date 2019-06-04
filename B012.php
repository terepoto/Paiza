<?php

class B012{

    protected $creditCards;

    public function setCredits()
    {
        $countOfCredits = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));

        for ($numberOfCredit = 1; $numberOfCredit <= $countOfCredits; $numberOfCredit++) {
            $creditCard = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
            $this->creditCards[] = $creditCard;
        }
    }

    public function getX()
    {
        foreach ($this->creditCards as $creditCard) {

            $even = 0;
            $odd = 0;

            $arrCreditCard = str_split($creditCard, 1);

            foreach ($arrCreditCard as $digit => $number) {

                if ($digit == 15) {
                    continue;
                }

                if ($digit % 2 == 0) {
                    $twiceNumber = 2 * $number;
                    $oneDigitNumber = $this->changeDigitToOne($twiceNumber);
                    $even += $oneDigitNumber;
                } else {
                    $odd += $number;
                }
            }

            $rightEndDigit = ($even + $odd) % 10 == 0 ? 0 : 10 - ($even + $odd) % 10;
            echo $rightEndDigit . PHP_EOL;
        }
    }

    public function changeDigitToOne($number)
    {
        if ($number >= 10) {
            $number = floor($number / 10) + $number % 10;
            $this->changeDigitToOne($number);
        }
        return $number;
    }
}

$B012 = new B012;
$B012->setCredits();
$B012->getX();