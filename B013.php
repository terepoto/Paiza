<?php
class DepartureTime
{
    private array $buses;

    private array $timeOfEachSection;

    private int $latestTimeAtCompany;

    public function __construct(array $buses, array $timeOfEachSection)
    {
        $this->buses               = $buses;
        $this->timeOfEachSection   = $timeOfEachSection;
        $this->latestTimeAtCompany = 8 * 60 + 59;
    }

    public function getLatestDepartureTime() : void
    {
        $latestTimeByBus = $this->latestTimeAtCompany - $this->timeOfEachSection["stationToCompany"] - $this->timeOfEachSection["travelTime"];

        $latestDepartureTimeOfBus = 0;

        foreach ($this->buses as $busNumber => $departureTimeOfBus) {

            if ($departureTimeOfBus <= $latestTimeByBus) {
                if ($busNumber == count($this->buses) - 1) {
                    $latestDepartureTimeOfBus = $departureTimeOfBus;
                    break;
                }

                if ($latestTimeByBus < $this->buses[$busNumber + 1]) {
                    $latestDepartureTimeOfBus = $departureTimeOfBus;
                    break;
                }
            }

        }

        $latestDepartureTimeFromHome = $latestDepartureTimeOfBus - $this->timeOfEachSection["homeToStation"];

        echo sprintf ("%02d", floor($latestDepartureTimeFromHome / 60 ) ) . ":" . sprintf ("%02d", $latestDepartureTimeFromHome % 60);
    }
}

$info = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
$arrInfo = explode(" ", $info);

$timeOfEachSection["homeToStation"]    = $arrInfo[0];
$timeOfEachSection["travelTime"]       = $arrInfo[1];
$timeOfEachSection["stationToCompany"] = $arrInfo[2];

$buses = array();
$countOfBus = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
for ($count = 1; $count <= $countOfBus; $count++) {
    $departureTime    = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
    $arrDepartureTime = explode(" ", $departureTime);
    $buses[]    = $arrDepartureTime[0] * 60 + $arrDepartureTime[1];
}

$departureTime = new DepartureTime($buses, $timeOfEachSection);
$departureTime->getLatestDepartureTime();