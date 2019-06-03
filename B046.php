<?php

class B046{

    protected $rounds;

    protected $nowAround;

    protected $nowDirection;

    protected $purposeAround;

    protected $purposeDirection;

    protected $distance;

    public function __construct()
    {
        $this->rounds = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
    }

    public function setNowPositionInfo()
    {
        $nowPosition       = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrNowPosition    = explode(" ", $nowPosition);

        $this->nowAround    = $arrNowPosition["0"];
        $this->nowDirection = $arrNowPosition["1"];
    }

    public function setPurposePositionInfo()
    {
        $purposePosition    = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrPurposePosition = explode(" ", $purposePosition);

        $this->purposeAround    = $arrPurposePosition[0];
        $this->purposeDirection = $arrPurposePosition[1];
    }

    public function calculationShortestDistance()
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
    }

    public function display()
    {
        echo $this->distance;
    }
}

$B046 = new B046;
$B046->setNowPositionInfo();
$B046->setPurposePositionInfo();
$B046->calculationShortestDistance();
$B046->display();