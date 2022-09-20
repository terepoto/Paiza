<?php

class Abacus
{
    private int $width;

    const HEIGHT = 8;

    public function __construct($width)
    {
        $this->width = $width;
    }

    public function getNumber()
    {
        $numbers = [];
        for ($i = 0; $i < self::HEIGHT; $i++) {
            $pearls = str_split(str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN))), 1);
            for ($position = 0; $position < $this->width; $position++) {
                $numbers[$position][] = $pearls[$position];
            }
        }

        $result = '';
        foreach ($numbers as $pearls) {
            $tmp = 0;
            foreach ($pearls as $position => $pearl) {
                if ($position < 2) {
                    if ($position == 1 && $pearl == '*') {
                        $tmp += 5;
                    }
                    continue;
                }
                if ($position == 2) {
                    continue;
                }
                if ($position > 2) {
                    if ($pearl == '|') {
                        break;
                    }
                    $tmp += 1;
                }
            }
            $result .= $tmp;
        }

        return (int)str_pad($result, $this->width, '0', STR_PAD_LEFT);
    }

    public function getResult($number)
    {
        $result = [];
        for ($i = 0; $i < self::HEIGHT; $i++) {
            for ($h = 0; $h < $this->width; $h++) {
                if ($i == 2) {
                    $result[$i][$h] = '=';
                    continue;
                }
                $result[$i][$h] = '*';
            }
        }

        $number = str_pad($number, $this->width, 0, STR_PAD_LEFT);
        $numbers = str_split($number, 1);
        for ($i = 0; $i < count($numbers); $i++) {
            if ($numbers[$i] < 5) {
                $result[0][$i] = '*';
                $result[1][$i] = '|';
            } else {
                $result[0][$i] = '|';
            }

            $number = $numbers[$i] >= 5 ? $numbers[$i] - 5 : $numbers[$i];
            $result[3 + (int)$number][$i] = '|';
        }

        for ($i = 0; $i < self::HEIGHT; $i++) {
            for ($h = 0; $h < $this->width; $h++) {
                echo $result[$i][$h];
            }
            echo PHP_EOL;
        }
    }
}

$width = str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN)));

$abacus = new Abacus($width);
$number1 = $abacus->getNumber();
$number2 = $abacus->getNumber();
$abacus->getResult($number1 + $number2);
