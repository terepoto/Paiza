<?php

class LongestSwipe
{

    private $line;

    private $queue;

    private $max = 1;

    public function __construct($line)
    {
        $this->line = $line;
    }

    public function setQueue()
    {
        for ($i = 0; $i < $this->line; $i++) {
            $this->queue[$i] = str_split(str_replace(array(PHP_EOL), '', fgets(STDIN)), 1);
        }
    }

    public function getLongestSwipe() {
        for ($y = 0; $y < $this->line; $y++) {
            for ($x = 0; $x < $this->line; $x++) {
                $count = [];
                $count['up'] = $this->checkAbleToSwipe($y, $x, 'up');
                $count['down'] = $this->checkAbleToSwipe($y, $x, 'down');
                $count['left'] = $this->checkAbleToSwipe($y, $x, 'left');
                $count['right'] = $this->checkAbleToSwipe($y, $x, 'right');
                $count['diagonalRightUp'] = $this->checkAbleToSwipe($y, $x, 'diagonalRightUp');
                $count['diagonalLeftUp'] = $this->checkAbleToSwipe($y, $x, 'diagonalLeftUp');
                $count['diagonalRightDown'] = $this->checkAbleToSwipe($y, $x, 'diagonalRightDown');
                $count['diagonalLeftDown'] = $this->checkAbleToSwipe($y, $x, 'diagonalLeftDown');
                $result = max($count);
                if ($result > $this->max) {
                    $this->max = $result;
                }
            }
        }
        echo $this->max;
    }

    public function checkAbleToSwipe($y, $x, $direction, $type = '', $count = 1)
    {
        switch ($direction) {
            case 'up':
                if ($y == 0) {
                    break;
                }
                if ($this->queue[$y - 1][$x] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x, $direction, '+', $count+1);
                }
                if ($this->queue[$y - 1][$x] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x, $direction, '-', $count+1);
                }
                break;
            case 'down':
                if ($y == $this->line - 1) {
                    break;
                }
                if ($this->queue[$y + 1][$x] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x, $direction, '+', $count+1);
                }
                if ($this->queue[$y + 1][$x] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x, $direction, '-', $count+1);
                }
                break;
            case 'left':
                if ($x == 0) {
                    break;
                }
                if ($this->queue[$y][$x - 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y, $x - 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y][$x - 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y, $x - 1, $direction, '-', $count+1);
                }
                break;
            case 'right':
                if ($x == $this->line - 1) {
                    break;
                }
                if ($this->queue[$y][$x + 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y, $x + 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y][$x + 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y, $x + 1, $direction, '-', $count+1);
                }
                break;
            case 'diagonalRightUp':
                if ($x == $this->line - 1 || $y == 0) {
                    break;
                }
                if ($this->queue[$y - 1][$x + 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x + 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y - 1][$x + 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x + 1, $direction, '-', $count+1);
                }
                break;
            case 'diagonalLeftUp':
                if ($x == 0 || $y == 0) {
                    break;
                }
                if ($this->queue[$y - 1][$x - 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x - 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y - 1][$x - 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y - 1, $x - 1, $direction, '-', $count+1);
                }
                break;
            case 'diagonalRightDown':
                if ($x == $this->line - 1 || $y == $this->line - 1) {
                    break;
                }
                if ($this->queue[$y + 1][$x + 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x + 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y + 1][$x + 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x + 1, $direction, '-', $count+1);
                }
                break;
            case 'diagonalLeftDown':
                if ($x == 0 || $y == $this->line - 1) {
                    break;
                }
                if ($this->queue[$y + 1][$x - 1] - $this->queue[$y][$x] == 1 && in_array($type, ['', '+'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x - 1, $direction, '+', $count+1);
                }
                if ($this->queue[$y + 1][$x - 1] - $this->queue[$y][$x] == -1 && in_array($type, ['', '-'])) {
                    $count = $this->checkAbleToSwipe($y + 1, $x - 1, $direction, '-', $count+1);
                }
                break;
        }
        return $count;
    }
}

$line = str_replace(array(PHP_EOL), '', fgets(STDIN));
$longestSwipe = new LongestSwipe($line);
$longestSwipe->setQueue();
$longestSwipe->getLongestSwipe();

