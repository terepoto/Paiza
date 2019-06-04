<?php
class StrongestMeans
{
    private array $cards;

    private array $countOfCard = array();

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    private function countCard() : void
    {
        foreach ($this->cards as $card) {

            if ($card == "*") {
                $this->countOfCard = $this->plusAllKindCardOne($this->cards, $this->countOfCard);
                continue;
            }
            $this->countOfCard[$card] = empty($this->countOfCard[$card]) ? 1 : $this->countOfCard[$card] + 1;

        }
    }

    public function getMeans() : string
    {
        $this->countCard();

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

    private function plusAllKindCardOne(array $cards, array $countOfCard) : array
    {
        $cards = array_unique($cards);

        foreach ($cards as $number => $card) {
            if ($card != "*") {
                $countOfCard[$card] = empty($countOfCard[$card]) ? 1 : $countOfCard[$card] + 1;
            }
        }

        return $countOfCard;
    }
}

$cards = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
$cards = str_split($cards, 1);
$strongMeans = new StrongestMeans($cards);
echo $strongMeans->getMeans();