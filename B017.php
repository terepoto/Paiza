<?php
class B017
{
    protected $cards;

    protected $countOfCard;

    public function __construct()
    {
        $cardGroup = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $this->cards = str_split($cardGroup, 1);
    }

    public function countCard()
    {
        foreach ($this->cards as $number => $card) {
            switch ($card) {
                case "*":
                    $this->plusAllKindCardOne($this->cards, $this->countOfCard);
                    break;
                default:
                    $this->countOfCard[$card] = !isset($this->countOfCard[$card]) ? 1 : $this->countOfCard[$card] + 1;
                    break;
            }
        }
    }

    public function getMeans()
    {
        $Means = "";
        switch (max($this->countOfCard)) {
            case "1":
                $Means = "NoPair";
                break;
            case "2":
                $Means = count($this->countOfCard) == 2 ? "TwoPair" : "OnePair";
                break;
            case "3":
                $Means = "ThreeCard";
                break;
            case "4":
                $Means = "FourCard";
                break;
        }
        echo $Means;
    }

    public function plusAllKindCardOne($cards, & $countOfCard)
    {
        $cards = array_unique($cards);
        foreach ($cards as $number => $card) {
            if ($card != "*") {
                $countOfCard[$card] = !isset($countOfCard[$card]) ? 1 : $countOfCard[$card] + 1;
            }
        }
    }
}

$B017 = new B017;
$B017->countCard();
$B017->getMeans();