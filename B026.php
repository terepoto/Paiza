<?php
class VendingMachine
{
    private array $coinInMachine;

    public function __construct($coinInMachine)
    {
        $this->coinInMachine = $coinInMachine;
    }

    public function sellResult(array $customers) : void
    {
        foreach ($customers as $customer) {

            $arrCustomer = explode(" ", $customer);

            //お客様が購入した商品の価格及び入れた各コインの枚数
            $productPrice = $arrCustomer[0];
            $useCoin[500] = $arrCustomer[1];
            $useCoin[100] = $arrCustomer[2];
            $useCoin[50]  = $arrCustomer[3];
            $useCoin[10]  = $arrCustomer[4];

            $changeCoin = array(
                "500" => "0",
                "100" => "0",
                "50"  => "0",
                "10"  => "0"
            );

            //お釣り
            $change = 500 * $useCoin[500] + 100 * $useCoin[100] + 50 * $useCoin[50] + 10 * $useCoin[10] - $productPrice;
            $tmpChange = $change;

            foreach ($this->coinInMachine as $coin => $coinNumber) {
                $this->change($coin, $coinNumber, $change, $changeCoin[$coin]);
            }

            $message = "";
            if ($this->checkIfPass($changeCoin, $tmpChange)) {

                //自動販売機内部コインの変化
                foreach ($this->coinInMachine as $coin => $coinNumber) {
                    $this->coinInMachine[$coin] = $coinNumber + $useCoin[$coin] - $changeCoin[$coin];
                }

                //出力
                $k = 0;
                foreach ($changeCoin as $coin => $count) {
                    $message .= $count;
                    if ($k == count($changeCoin) - 1) {
                        break;
                    }
                    $message .= " ";
                    $k++;
                }

            } else {
                $message .= "impossible";
            }
            echo $message;
            echo PHP_EOL;
        }
    }

    private function change(int $coin, int $coinNumber, int & $change, int & $changeCoin) : void
    {
        if ($change < $coin) {
            return;
        }
        for ($num = $coinNumber; $num >= 0; $num--) {
            $price = $change - $num * $coin;
            if ($price >= 0) {
                $change = $change - $num * $coin;
                $changeCoin = $num;
                return;
            }
        }
    }

    private function checkIfPass(array $changeCoin, int $tmpChange) : bool
    {
        if ($changeCoin[50] * 50 + $changeCoin[10] * 10 >= 100) {
            return false;
        }
        foreach ($this->coinInMachine as $coin => $coinNumber) {
            if ($changeCoin[$coin] > $coinNumber) {
                return false;
            }
        }
        if (($changeCoin[500] * 500 + $changeCoin[100] * 100 + $changeCoin[50] * 50 + $changeCoin[10] * 10 != $tmpChange)) {
            return false;
        }
        return true;
    }
}


$info = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
$arrInfo = explode(" ", $info);

$coinInMachine[500] = $arrInfo[0];
$coinInMachine[100] = $arrInfo[1];
$coinInMachine[50]  = $arrInfo[2];
$coinInMachine[10]  = $arrInfo[3];

$countOfCustomer = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
$customers = array();
for ($num = 1; $num <= $countOfCustomer; $num++) {
    $customers[] = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
}

$vendingMachine = new VendingMachine($coinInMachine);
$vendingMachine->sellResult($customers);