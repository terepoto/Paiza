<?php
class B046
{
    private int $rounds;

    private int $nowAround;

    private string $nowDirection;

    private int $purposeAround;

    private string $purposeDirection;

    private float $distance;

    public function __construct($info)
    {
        $this->rounds = str_replace(array("\r\n","\r","\n"), '', $info);
    }

    public function setNowPositionInfo($info)
    {
        $nowPosition       = str_replace(array("\r\n","\r","\n"), '', $info);
        $arrNowPosition    = explode(" ", $nowPosition);

        $this->nowAround    = $arrNowPosition["0"];
        $this->nowDirection = $arrNowPosition["1"];
    }

    public function setPurposePositionInfo($info)
    {
        $purposePosition    = str_replace(array("\r\n","\r","\n"), '', $info);
        $arrPurposePosition = explode(" ", $purposePosition);

        $this->purposeAround    = $arrPurposePosition[0];
        $this->purposeDirection = $arrPurposePosition[1];
    }

    public function calculationShortestDistance() : float
    {
        $checkDirection   = $this->nowDirection.$this->purposeDirection;
        $oneLineDirection = array("NS", "SN", "WE", "EW", "NN", "SS", "WW", "EE");

        if (in_array($checkDirection, $oneLineDirection)) {
            if ($this->nowDirection == $this->purposeDirection) {
                $this->distance = abs($this->nowAround - $this->purposeAround) * 100;
            } else {
                $this->distance = ($this->nowAround + $this->purposeAround) * 100;
            }
        } else {
            if ($this->nowAround < $this->purposeAround) {
                $this->distance = abs($this->nowAround - $this->purposeAround) * 100 + M_PI * 100 * $this->nowAround / 2;
            } elseif ($this->nowAround > $this->purposeAround) {
                $this->distance = abs($this->nowAround - $this->purposeAround) * 100 + M_PI * 100 * $this->purposeAround / 2;
            } else {
                $this->distance = M_PI * 100 * $this->purposeAround / 2;
            }
        }

        return $this->distance;
    }

    public function display() : float
    {
        return $this->distance;
    }
}

$B046 = new B046(fgets(STDIN));
$B046->setNowPositionInfo(fgets(STDIN));
$B046->setPurposePositionInfo(fgets(STDIN));
$B046->calculationShortestDistance();
echo $B046->display();