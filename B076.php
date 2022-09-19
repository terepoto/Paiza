<?php

class BreadOrder
{

    private $kindOfBreads;

    private $orderTimes;

    private array $breads = [];

    public function __construct($infos)
    {
        $infos = explode(' ', $infos);
        $this->kindOfBreads = $infos[0];
        $this->orderTimes = $infos[1];
    }

    public function setBreads()
    {
        for ($i = 1; $i <= $this->kindOfBreads; $i++) {
            $breadInfo = explode(' ', str_replace(array("\r\n", "\r", "\n"), '', fgets(STDIN)));
            $this->breads[$i] = [
                'price' => $breadInfo[0],
                'count' => $breadInfo[1]
            ];
        }
    }

    public function checkOrder()
    {
        for ($i = 1; $i <= $this->orderTimes; $i++) {
            $orderInfo = explode(' ', str_replace(array("\r\n", "\r", "\n"), '', fgets(STDIN)));
            $orderType = $orderInfo[0];
            switch ($orderType) {
                case 'bake':
                    foreach ($orderInfo as $key => $count) {
                        if ($key == 0) {
                            continue;
                        }
                        $this->breads[$key]['count'] += $count;
                    }

                    break;
                case 'buy':
                    $price = 0;
                    foreach ($orderInfo as $key => $count) {
                        if ($key == 0) {
                            continue;
                        }
                        if ($this->breads[$key]['count'] < $count) {
                            echo '-1' . PHP_EOL;
                            break 2;
                        }
                    }
                    foreach ($orderInfo as $key => $count) {
                        if ($key == 0) {
                            continue;
                        }
                        $this->breads[$key]['count'] -= $count;
                        $price += $this->breads[$key]['price'] * $count;
                    }

                    echo $i == $this->orderTimes ? $price : $price . PHP_EOL;

                    break;
            }
        }
    }

}

$info = str_replace(array("\r\n", "\r", "\n"), '', fgets(STDIN));
$BreadOrder = new BreadOrder($info);
$BreadOrder->setBreads();
$BreadOrder->checkOrder();
