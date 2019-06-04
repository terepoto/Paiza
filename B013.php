<?php

class B013{

    private int $timeToStation;

    private int $timeTravel;

    private int $timeToFactory;

    private int $timeOfLate;

    private int $lastTimeByBus;

    private array $buses;

    private int $latestTimeFromHome;

    public function __construct(string $info)
    {
        $info = str_replace(array("\r\n","\r","\n"), '', $info);
        $arrInfo = explode(" ", $info);

        $this->timeToStation = $arrInfo[0];
        $this->timeTravel    = $arrInfo[1];
        $this->timeToFactory = $arrInfo[2];
    }

    public function setTimeOfLate(int $hour, int $minute) : int
    {
        return $this->timeOfLate = $hour * 60 + $minute;
    }

    public function setLastTimeByBus() : int
    {
        return $this->lastTimeByBus = $this->timeOfLate - ( $this->timeTravel + $this->timeToFactory);
    }

    public function setBusInfo(string $info) : array
    {
        $countOfBus = str_replace(array("\r\n","\r","\n"), '', $info);

        for ($count = 1; $count <= $countOfBus; $count++) {
            $departureTime    = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
            $arrDepartureTime = explode(" ", $departureTime);
            $this->buses[]    = $arrDepartureTime[0] * 60 + $arrDepartureTime[1];
        }

        return $this->buses;
    }

    public function getTimeOutHome() : int
    {
        $time = 0;
        foreach ($this->buses as $busNumber => $minute) {
            //終電なら
            if ($busNumber == count($this->buses) -1) {
                $time = $minute;
                break;
            }

            if ($minute <= $this->lastTimeByBus && $this->lastTimeByBus < $this->buses[$busNumber + 1]) {
                $time = $minute;
                break;
            }
        }

        return $this->latestTimeFromHome = $time - $this->timeToStation;
    }

    public function display() : string
    {
        return sprintf ("%02d", floor($this->latestTimeFromHome / 60 ) ). ":" . sprintf ("%02d", $this->latestTimeFromHome % 60);
    }
}

$B013 = new B013(fgets(STDIN));
$B013->setTimeOfLate(8, 59);
$B013->setLastTimeByBus();
$B013->setBusInfo(fgets(STDIN));
$B013->getTimeOutHome();
echo $B013->display();