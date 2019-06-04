<?php
class B026
{
    private array $countOfCoin;

    private int $countOfPeople;

    public function __construct($info_coin, $info_people)
    {
        $info = str_replace(array("\r\n","\r","\n"), '', $info_coin);
        $arrInfo = explode(" ", $info);

        $this->countOfCoin[500] = $arrInfo[0];
        $this->countOfCoin[100] = $arrInfo[1];
        $this->countOfCoin[50] = $arrInfo[2];
        $this->countOfCoin[10] = $arrInfo[3];

        $this->countOfPeople = str_replace(array("\r\n","\r","\n"), '', $info_people);
    }

    public function sell($info_customer) : string
    {
        $message = "";
        $arrCustomerInfo = $this->getCustomerInfo($info_customer);

        $changeInfo = array(
            "500" => "0",
            "100" => "0",
            "50"  => "0",
            "10"  => "0"
        );

        //商品総価、各コイン入れた数
        $price    = $arrCustomerInfo[0];
        $coin_500 = $arrCustomerInfo[1];
        $coin_100 = $arrCustomerInfo[2];
        $coin_50  = $arrCustomerInfo[3];
        $coin_10  = $arrCustomerInfo[4];

        //お釣り
        $change = 500 * $coin_500 + 100 * $coin_100 + 50 * $coin_50 + 10 * $coin_10 - $price;
        $old_change = $change;
        $this->getChange(500, $change, $this->countOfCoin[500], $changeInfo[500]);
        $this->getChange(100, $change, $this->countOfCoin[100], $changeInfo[100]);
        $this->getChange(50, $change, $this->countOfCoin[50], $changeInfo[50]);
        $this->getChange(10, $change, $this->countOfCoin[10], $changeInfo[10]);


        if ($changeInfo[50] *50 + $changeInfo[10] * 10 < 100
            && $changeInfo[500] <= $this->countOfCoin[500]
            && $changeInfo[100] <= $this->countOfCoin[100]
            && $changeInfo[50] <= $this->countOfCoin[50]
            && $changeInfo[10] <= $this->countOfCoin[10]
            && ($changeInfo[500] * 500 + $changeInfo[100] * 100 + $changeInfo[50] * 50 + $changeInfo[10] * 10) == $old_change
        ) {
            //自動販売機内部コインの変化
            $this->countOfCoin[500] = $this->countOfCoin[500] + $coin_500 - $changeInfo[500];
            $this->countOfCoin[100] = $this->countOfCoin[100] + $coin_100 - $changeInfo[100];
            $this->countOfCoin[50]  = $this->countOfCoin[50] + $coin_50 - $changeInfo[50];
            $this->countOfCoin[10]  = $this->countOfCoin[10] + $coin_10 - $changeInfo[10];
            //結果出力
            $k = 0;
            foreach ($changeInfo as $coin => $count) {
                $message .= $count;
                if ($k != count($changeInfo) - 1){
                    $message .= " ";
                }
                $k++;
            }
        } else {
            $message .= "impossible";
        }
        return $message .= PHP_EOL;
    }

    public function getCustomerInfo($info_customer) : array
    {
        $customerInfo = str_replace(array("\r\n","\r","\n"), '', $info_customer);
        $arrCustomerInfo = explode(" ", $customerInfo);

        return $arrCustomerInfo;
    }

    public function getChange($coin, & $change, & $countOfCoin, & $changeInfo)
    {
        for ($num = $countOfCoin; $num >= 0; $num--) {
            $price = $change - $num * $coin;
            if ($price >= 0) {
                $change = $change - $num * $coin;
                $changeInfo = $num;
                break;
            }
        }
    }

    public function  getCountOfPeople() : int
    {
        return $this->countOfPeople;
    }
}

$B026 = new B026(trim(fgets(STDIN)), trim(fgets(STDIN)));
for ($num = 1; $num <= $B026->getCountOfPeople(); $num++) {
    echo $B026->sell(trim(fgets(STDIN)));
}