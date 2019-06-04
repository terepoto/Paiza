<?php
class B017
{
    private array $cards;

    private array $countOfCard = array();

    public function __construct(string $info)
    {
        $cardGroup = str_replace(array("\r\n","\r","\n"), '', $info);
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
                    $this->countOfCard[$card] = empty($this->countOfCard[$card]) ? 1 : $this->countOfCard[$card] + 1;
                    break;
            }
        }
    }

    public function getMeans()
    {
        $means = "";
        switch (max($this->countOfCard)) {
            case "1":
                $means = "NoPair";
                break;
            case "2":
                $means = count($this->countOfCard) == 2 ? "TwoPair" : "OnePair";
                break;
            case "3":
                $means = "ThreeCard";
                break;
            case "4":
                $means = "FourCard";
                break;
        }
        echo $means;
    }

    public function plusAllKindCardOne(array $cards, array & $countOfCard)
    {
        $cards = array_unique($cards);
        foreach ($cards as $number => $card) {
            if ($card != "*") {
                $countOfCard[$card] = !isset($countOfCard[$card]) ? 1 : $countOfCard[$card] + 1;
            }
        }
    }
}

$B017 = new B017(fgets(STDIN));
$B017->countCard();
$B017->getMeans();