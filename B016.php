<?php
class B016
{
    private array $board;

    private int $move_times;

    private int $move_info;

    private array $player;

    public function __construct(string $info)
    {
        $info    = str_replace(array("\r\n", "\r", "\n"), '', $info);
        $arrInfo = explode(" ", $info);

        $this->board["W"] = $arrInfo[0];
        $this->board["H"] = $arrInfo[1];
        $this->move_times = $arrInfo[2];
    }

    public function setPlayerPosition(string $info)
    {
        $player_position    = str_replace(array("\r\n", "\r", "\n"), '', $info);
        $arrPlayer_position = explode(" ", $player_position);

        $this->player["X"] = $arrPlayer_position[0];
        $this->player["Y"] = $arrPlayer_position[1];
    }

    public function setMoveInfo(string $info)
    {
        for ($times = 1; $times <= $this->move_times; $times++) {
            $this->move_info[] = str_replace(array("\r\n", "\r", "\n"), '', $info);
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

    public function move(string $direction, int $step, int & $X, int & $Y, int $W, int $H)
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

$B016 = new B016(trim(fgets(STDIN)));
$B016->setPlayerPosition(trim(fgets(STDIN)));
$B016->setMoveInfo(trim(fgets(STDIN)));
$B016->getFinalPosition();
$B016->display();