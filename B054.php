<?php
class B054
{
    private string $code_Pa;

    private array $rule_PaToDecimal5;

    private array $rule_Decimal5ToPa;

    private string $code_first;

    private string $code_second;

    private string $result;

    public function __construct(string $info)
    {
        $this->code_Pa = str_replace(array("\r\n","\r","\n"), '', $info);
        $arrCode = explode(" ", $this->code_Pa);

        $this->code_first  = $arrCode[0];
        $this->code_second = $arrCode[1];
    }

    public function setRule(array $rule)
    {
        $this->rule_PaToDecimal5 = $rule;
        $this->rule_Decimal5ToPa = array_flip($rule);
    }

    public function changeStart() : string
    {
        $this->code_first  = $this->changeBetweenPaAndDecimal5($this->code_first, $this->rule_PaToDecimal5);
        $this->code_second = $this->changeBetweenPaAndDecimal5($this->code_second, $this->rule_PaToDecimal5);

        $sumDecimal5 = $this->getSumDecimal5();
        $this->result = $this->changeBetweenPaAndDecimal5($sumDecimal5, $this->rule_Decimal5ToPa);

        return $this->result;
    }

    public function changeBetweenPaAndDecimal5(string $target, array $rule) : string
    {
        $result  = "";
        $arrCode = str_split($target, 1);

        foreach($arrCode as $digit => $code){
            $result .= $rule[$code];
        }

        return $result;
    }

    public function display() : string
    {
        return $this->result;
    }

    public function getSumDecimal5() : string
    {
        $sumDecimal10 = (int)base_convert($this->code_first, 5, 10) + (int)base_convert($this->code_second, 5, 10);
        $sumDecimal5  = base_convert($sumDecimal10, 10, 5);
        return $sumDecimal5;
    }
}

$B054 = new B054(fgets(STDIN));
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
echo $B054->display();