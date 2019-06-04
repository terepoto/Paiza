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

    public function countCard() : array
    {
        foreach ($this->cards as $number => $card) {
            switch ($card) {
                case "*":
                    $this->countOfCard = $this->plusAllKindCardOne($this->cards, $this->countOfCard);
                    break;
                default:
                    $this->countOfCard[$card] = empty($this->countOfCard[$card]) ? 1 : $this->countOfCard[$card] + 1;
                    break;
            }
        }
        return $this->countOfCard;
    }

    public function getMeans() : string
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
        return $means;
    }

    public function plusAllKindCardOne(array $cards, array $countOfCard) : array
    {
        $cards = array_unique($cards);

        foreach ($cards as $number => $card) {
            if ($card != "*") {
                $countOfCard[$card] = !isset($countOfCard[$card]) ? 1 : $countOfCard[$card] + 1;
            }
        }

        return $countOfCard;
    }
}

$B017 = new B017(fgets(STDIN));
$B017->countCard();
echo $B017->getMeans();