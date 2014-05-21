<?php
function arrayToXml($array,$lastkey=’root’)
{
    $buffer.="<".$lastkey.">\n";
    if (!is_array($array))
    {$buffer.=$array;}
    else
    {
        foreach($array as $key=>$value)
        {
            if (is_array($value))
            {
                if ( is_numeric(key($value)))
                {
                    foreach($value as $bkey=>$bvalue)
                    {
                        $buffer.=arrayToXml($bvalue,$key);
                    }
                }
                else
                {
                    $buffer.=arrayToXml($value,$key);
                }
            }
            else
            {
                    $buffer.=arrayToXml($value,$key);
            }
        }
    }
    $buffer.="</".$lastkey.">\n";
    return $buffer;
}
?>