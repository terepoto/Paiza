<?php

class B006{

    protected $o_y;

    protected $speed;

    protected $theta;

    protected $distanceToTarget;

    protected $targetHeight;

    protected $targetDiameter;

    public function __construct()
    {
        $info    = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrInfo = explode(" ", $info);

        $this->o_y   = $arrInfo[0];
        $this->speed = $arrInfo[1];
        $this->theta = $arrInfo[2];

        $info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrInfo = explode(" ", $info);
        $this->distanceToTarget = $arrInfo[0]; //的までの距離x
        $this->targetHeight     = $arrInfo[1]; //高さy
        $this->targetDiameter   = $arrInfo[2]; //的の大きさ
    }

    public function checkIfHit()
    {
        $y = $this->o_y + tan(M_PI / 180 * $this->theta) * $this->distanceToTarget - ( 9.8 * pow($this->distanceToTarget, 2))
            / ( 2 * pow($this->speed, 2) * pow(cos(M_PI / 180 * $this->theta), 2) );
        $y = round($y, 1);

        $targetRadius = $this->targetDiameter / 2;

        if ($this->targetHeight - $targetRadius > $y || $this->targetHeight + $targetRadius < $y) {
            echo "Miss";
        } else {
            echo "Hit" . " " . abs($this->targetHeight - $y);
        }
    }
}

$B006 = new B006;
$B006->checkIfHit();