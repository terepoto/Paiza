<?php
class FirstDigitOfCreditCard
{
    private array $creditCards;

    public function __construct($creditCards)
    {
        $this->creditCards = $creditCards;
    }

    public function getFirstDigitOfCreditCard() : void
    {
        foreach ($this->creditCards as $creditCard) {
            $odd  = 0;
            $even = 0;

            $arrCreditCard = str_split($creditCard, 1);

            foreach ($arrCreditCard as $digit => $number) {
                if ($digit == 15) {
                    continue;
                }

                if ($digit % 2 == 0) {
                    $twiceOfNumber  = 2 * $number;
                    $oneDigitNumber = $this->changeDigitToOne($twiceOfNumber);
                    $even += $oneDigitNumber;
                } else {
                    $odd += $number;
                }
            }
            $FirstDigitOfCreditCard = ($even + $odd) % 10 == 0 ? 0 : 10 - ($even + $odd) % 10;

            echo $FirstDigitOfCreditCard . PHP_EOL;
        }
    }

    private function changeDigitToOne(int $number) : int
    {
        if ($number >= 10) {
            $number = floor($number / 10) + $number % 10;
            $this->changeDigitToOne($number);
        }
        return $number;
    }
}

$countOfCredits = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));

$creditCards = array();
for ($num = 1; $num <= $countOfCredits; $num++) {
    $creditCard = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
    $creditCards[] = $creditCard;
}

$FirstDigitOfCreditCard = new FirstDigitOfCreditCard($creditCards);
$FirstDigitOfCreditCard->getFirstDigitOfCreditCard();