<?php
class B012
{
    private array $creditCards;

    public function setCredits(string $info) : array
    {
        $countOfCredits = str_replace(array("\r\n","\r","\n"), '', $info);

        for ($numberOfCredit = 1; $numberOfCredit <= $countOfCredits; $numberOfCredit++) {
            $creditCard = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
            $this->creditCards[] = $creditCard;
        }

        return $this->creditCards;
    }

    public function getX() : string
    {
        $message = "";

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
            $message .= $rightEndDigit . PHP_EOL;
        }
        return $message;
    }

    public function changeDigitToOne(int $number) : int
    {
        if ($number >= 10) {
            $number = floor($number / 10) + $number % 10;
            $this->changeDigitToOne($number);
        }
        return $number;
    }
}

$B012 = new B012;
$B012->setCredits(fgets(STDIN));
echo $B012->getX();