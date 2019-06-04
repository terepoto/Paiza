<?php
class B050
{
    private $countOfTicket;

    private $code;

    private $pattern;

    public function __construct($info_count, $info_code)
    {
        $this->countOfTicket = str_replace(array("\r\n","\r","\n"), '', $info_count);
        $this->code          = str_replace(array("\r\n","\r","\n"), '', $info_code);
    }

    public function readTicket() : string
    {
        return str_replace(array("\r\n","\r","\n"), '', trim(fgets(STDIN)));
    }

    public function setPattern() : string
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

        return $this->pattern = $pattern;
    }

    public function checkIfValid() : string
    {
        $message = "";
        for ($num = 1; $num <= $this->countOfTicket; $num++) {
            $ticket = $this->readTicket();

            if (preg_match($this->pattern, $ticket, $matches)) {
                if (strlen($matches[0]) == strlen($this->code) || strlen($matches[0]) == strlen($this->code) + 1) {
                    $message .= "valid" . PHP_EOL;
                    continue;
                }
            }

            $message .= "invalid" . PHP_EOL;
        }
        return $message;
    }
}

$B050 = new B050(trim(fgets(STDIN)), trim(fgets(STDIN)));
$B050->setPattern();
echo $B050->checkIfValid();