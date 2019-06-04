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
                $this->plusAllKindCardOne();
                continue;
            }
            $this->plusSpecifiedCardOne($card);
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

    private function plusAllKindCardOne() : void
    {
        $cards = array_unique($this->cards);

        foreach ($cards as $card) {
            if ($card != "*") {
                $this->plusSpecifiedCardOne($card);
            }
        }
    }

    private function plusSpecifiedCardOne($card) : void
    {
        $this->countOfCard[$card] = empty($this->countOfCard[$card]) ? 1 : $this->countOfCard[$card] + 1;
    }
}

$cards = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
$cards = str_split($cards, 1);

$strongMeans = new StrongestMeans($cards);
echo $strongMeans->getMeans();