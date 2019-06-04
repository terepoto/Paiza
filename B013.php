<?php

class B013{

    protected $timeToStation;

    protected $timeTravel;

    protected $timeToFactory;

    protected $timeOfLate;

    protected $lastTimeByBus;

    protected $buses;

    protected $latestTimeFromHome;

    public function __construct()
    {
        $info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrInfo = explode(" ", $info);

        $this->timeToStation = $arrInfo[0];
        $this->timeTravel    = $arrInfo[1];
        $this->timeToFactory = $arrInfo[2];
    }

    public function setTimeOfLate($hour, $minute)
    {
        $this->timeOfLate = $hour * 60 + $minute;
    }

    public function setLastTimeByBus()
    {
        $this->lastTimeByBus = $this->timeOfLate - ( $this->timeTravel + $this->timeToFactory);
    }

    public function setBusInfo()
    {
        $countOfBus = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));

        for ($count = 1; $count <= $countOfBus; $count++) {
            $departureTime    = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
            $arrDepartureTime = explode(" ", $departureTime);
            $this->buses[]    = $arrDepartureTime[0] * 60 + $arrDepartureTime[1];
        }
    }

    public function getTimeOutHome()
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

        $this->latestTimeFromHome = $time - $this->timeToStation;
    }

    public function display()
    {
        echo sprintf ("%02d", floor($this->latestTimeFromHome / 60 ) ). ":" . sprintf ("%02d", $this->latestTimeFromHome % 60);
    }
}

$B013 = new B013;
$B013->setTimeOfLate(8, 59);
$B013->setLastTimeByBus();
$B013->setBusInfo();
$B013->getTimeOutHome();
$B013->display();