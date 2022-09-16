<?php

class SearchSummit {

    private int $size;

    private array $mountain;

    private array $top;

    public function __construct(int $size) {
        $this->size = $size;
    }

    public function setMountain() {
        for ($i = 0; $i < $this->size; $i++) {
            $mountain = explode(' ', str_replace(array(PHP_EOL), '', fgets(STDIN)));
            $this->mountain[$i] = $mountain;
        }
    }

    public function searchSummit() {
        foreach ($this->mountain as $y => $infos) {
            foreach ($infos as $x => $value) {
                if ($y != $this->size - 1 && $this->mountain[$y + 1][$x] >= $value) {
                    continue;
                }
                if ($y != 0 && $this->mountain[$y - 1][$x] >= $value) {
                    continue;
                }
                if ($x != $this->size - 1 && $this->mountain[$y][$x + 1] >= $value) {
                    continue;
                }
                if ($x != 0 && $this->mountain[$y][$x - 1] >= $value) {
                    continue;
                }
                $this->top[] = $value;
            }
        }
        rsort($this->top);
        foreach ($this->top as $height) {
            echo $height . PHP_EOL;
        }
    }
}

$size = str_replace(array(PHP_EOL), '', fgets(STDIN));
$B019 = new SearchSummit($size);
$B019->setMountain();
$B019->searchSummit();