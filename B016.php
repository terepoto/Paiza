<?php
class RpgGame
{
    private array $board;

    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function getAfterMovePosition(array $playerPosition, array $moveInfos) : void
    {
        foreach ($moveInfos as $moveInfo) {
            $this->move($moveInfo, $playerPosition);
        }
        echo $playerPosition["X"] . " " . $playerPosition["Y"];
    }

    private function move(array $moveInfo, array & $playerPosition) : void
    {
        $direction = $moveInfo[0];
        $step      = $moveInfo[1];

        $heightOfBoard = $this->board["H"];
        $widthOfBoard  = $this->board["W"];

        switch ($direction) {
            case "U":
                $relativeStep = $step % $heightOfBoard;
                if ($playerPosition["Y"] + $relativeStep > $heightOfBoard - 1) {
                    $playerPosition["Y"] = $relativeStep - ( $heightOfBoard - $playerPosition["Y"] );
                } else {
                    $playerPosition["Y"] += $relativeStep;
                }
                break;
            case "D":
                $relativeStep = $step % $heightOfBoard;
                if ($playerPosition["Y"] - $relativeStep < 0) {
                    $playerPosition["Y"] = $heightOfBoard - ( $relativeStep - $playerPosition["Y"] );
                } else {
                    $playerPosition["Y"] -= $relativeStep;
                }
                break;
            case "L":
                $relativeStep = $step % $widthOfBoard;
                if ($playerPosition["X"] - $relativeStep < 0) {
                    $playerPosition["X"] = $widthOfBoard - ( $relativeStep - $playerPosition["X"] );
                } else {
                    $playerPosition["X"] -= $relativeStep;
                }
                break;
            case "R":
                $relativeStep = $step % $widthOfBoard;
                if ($playerPosition["X"] + $relativeStep > $widthOfBoard - 1) {
                    $playerPosition["X"] = $relativeStep - ( $widthOfBoard - $playerPosition["X"] );
                } else {
                    $playerPosition["X"] += $relativeStep;
                }
                break;
        }
    }
}

$board  = array();
$player = array();

$info    = str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN)));
$arrInfo = explode(" ", $info);

$board["W"] = $arrInfo[0];
$board["H"] = $arrInfo[1];
$move_times = $arrInfo[2];

$arrPlayInfo  = explode(" ", str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN))));
$playerPosition["X"] = $arrPlayInfo[0];
$playerPosition["Y"] = $arrPlayInfo[1];

$moveInfos = array();
for ($num = 1; $num <= $move_times; $num++) {
    $moveInfos[] = explode(" ", str_replace(array("\r\n", "\r", "\n"), '', trim(fgets(STDIN))));
}

$rpgGame = new RpgGame($board);
$rpgGame->getAfterMovePosition($playerPosition, $moveInfos);