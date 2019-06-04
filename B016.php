<?php
class B016
{
    protected $board;

    protected $move_times;

    protected $player;

    protected $move_info;

    public function __construct()
    {
        $info    = str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN)));
        $arrInfo = explode(" ", $info);

        $this->board["W"] = $arrInfo[0];
        $this->board["H"] = $arrInfo[1];
        $this->move_times = $arrInfo[2];
    }

    public function setPlayerPosition()
    {
        $player_position    = str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN)));
        $arrPlayer_position = explode(" ", $player_position);

        $this->player["X"] = $arrPlayer_position[0];
        $this->player["Y"] = $arrPlayer_position[1];
    }

    public function setMoveInfo()
    {
        for ($times = 1; $times <= $this->move_times; $times++) {
            $this->move_info[] = str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN)));
        }
    }

    public function getFinalPosition()
    {
        foreach ($this->move_info as $time => $move_info) {
            $arrMoveInfo = explode(" ", $move_info);
            $direction   = $arrMoveInfo[0];
            $step        = $arrMoveInfo[1];
            $this->move($direction, $step, $this->player["X"], $this->player["Y"], $this->board["W"], $this->board["H"]);
        }
    }

    public function move($direction, $step, & $X, & $Y, $W, $H)
    {
        switch ($direction) {
            case "U":
                $step = $step % $H;
                if ($Y + $step > $H - 1) {
                    $Y = $step - ( $H - $Y );
                } else {
                    $Y += $step;
                }
                break;
            case "D":
                $step = $step % $H;
                if ($Y - $step < 0) {
                    $Y = $H - ( $step - $Y );
                } else {
                    $Y -= $step;
                }
                break;
            case "L":
                $step = $step % $W;
                if ($X - $step < 0) {
                    $X = $W - ( $step - $X );
                } else {
                    $X -= $step;
                }
                break;
            case "R":
                $step = $step % $W;
                if ($X + $step > $W - 1) {
                    $X = $step - ( $W - $X );
                } else {
                    $X += $step;
                }
                break;
        }
    }

    public function display()
    {
        echo $this->player["X"] . " " . $this->player["Y"];
    }
}

$B016 = new B016;
$B016->setPlayerPosition();
$B016->setMoveInfo();
$B016->getFinalPosition();
$B016->display();