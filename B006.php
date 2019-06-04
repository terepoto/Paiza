<?php
class B006
{
    private int $o_y;

    private int $speed;

    private int $theta;

    private int $distanceToTarget;

    private int $targetHeight;

    private int $targetDiameter;

    public function __construct($info_arrow, $infotarget)
    {
        $info    = str_replace(array("\r\n","\r","\n"), '', $info_arrow);
        $arrInfo = explode(" ", $info);

        $this->o_y   = $arrInfo[0];
        $this->speed = $arrInfo[1];
        $this->theta = $arrInfo[2];

        $info = str_replace(array("\r\n","\r","\n"), '', $infotarget);
        $arrInfo = explode(" ", $info);
        $this->distanceToTarget = $arrInfo[0]; //的までの距離x
        $this->targetHeight     = $arrInfo[1]; //高さy
        $this->targetDiameter   = $arrInfo[2]; //的の大きさ
    }

    public function checkIfHit() : string
    {
        $result = "";

        $y = $this->o_y + tan(M_PI / 180 * $this->theta) * $this->distanceToTarget - ( 9.8 * pow($this->distanceToTarget, 2))
            / ( 2 * pow($this->speed, 2) * pow(cos(M_PI / 180 * $this->theta), 2) );
        $y = round($y, 1);

        $targetRadius = $this->targetDiameter / 2;

        if ($this->targetHeight - $targetRadius > $y || $this->targetHeight + $targetRadius < $y) {
            $result .= "Miss";
        } else {
            $result .= "Hit" . " " . abs($this->targetHeight - $y);
        }

        return $result;
    }
}

$B006 = new B006(fgets(STDIN), fgets(STDIN));
echo $B006->checkIfHit();