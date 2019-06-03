<?php

class B054{

    protected $code_Pa;

    protected $rule_PaToDecimal5;

    protected $rule_Decimal5ToPa;

    protected $code_first;

    protected $code_second;

    protected $result;

    public function __construct()
    {
        $this->code_Pa = str_replace(array("\r\n","\r","\n"), '', fgets(STDIN));
        $arrCode = explode(" ", $this->code_Pa);

        $this->code_first  = $arrCode[0];
        $this->code_second = $arrCode[1];
    }

    public function setRule($rule)
    {
        $this->rule_PaToDecimal5 = $rule;
        $this->rule_Decimal5ToPa = array_flip($rule);
    }

    public function changeStart()
    {
        $this->code_first  = $this->changeBetweenPaAndDecimal5($this->code_first, $this->rule_PaToDecimal5);
        $this->code_second = $this->changeBetweenPaAndDecimal5($this->code_second, $this->rule_PaToDecimal5);

        $sumDecimal5 = $this->getSumDecimal5();
        $this->result = $this->changeBetweenPaAndDecimal5($sumDecimal5, $this->rule_Decimal5ToPa);
    }

    public function changeBetweenPaAndDecimal5($target, $rule)
    {
        $result  = "";
        $arrCode = str_split($target, 1);

        foreach($arrCode as $digit => $code){
            $result .= $rule[$code];
        }

        return $result;
    }

    public function display()
    {
        echo $this->result;
    }

    public function getSumDecimal5()
    {
        $sumDecimal10 = (int)base_convert($this->code_first, 5, 10) + (int)base_convert($this->code_second, 5, 10);
        $sumDecimal5  = base_convert($sumDecimal10, 10, 5);
        return $sumDecimal5;
    }
}

$B054 = new B054;
$B054->setRule(
  [
      "A" => 0,
      "B" => 1,
      "C" => 2,
      "D" => 3,
      "E" => 4
  ]
);
$B054->changeStart();
$B054->display();