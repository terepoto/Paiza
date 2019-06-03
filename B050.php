<?php

class B050{

    protected $countOfTicket;

    protected $code;

    protected $pattern;

    public function __construct()
    {
        $this->countOfTicket = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
        $this->code          = str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
    }

    public function readTicket()
    {
        return str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
    }

    public function setPattern()
    {
        $arrCode = str_split($this->code, 1);

        $pattern = "/";

        foreach ($arrCode as $key => $word) {
            $pattern .= $word;
            if ($key == 0) {
                $pattern .= "[^$word]?";
            } elseif ($key != count($arrCode) - 1) {
                $pattern .= "[a-z]?";
            }
        }

        $pattern .= "/U";

        $this->pattern = $pattern;
    }

    public function checkIfValid()
    {
        for ($num = 1; $num <= $this->countOfTicket; $num++) {
            $ticket = $this->readTicket();

            if (preg_match($this->pattern, $ticket, $matches)) {
                if (strlen($matches[0]) == strlen($this->code) || strlen($matches[0]) == strlen($this->code) + 1) {
                    echo "valid" . PHP_EOL;
                    continue;
                }
            }

            echo "invalid" . PHP_EOL;
        }
    }
}

$B050 = new B050;
$B050->setPattern();
$B050->checkIfValid();