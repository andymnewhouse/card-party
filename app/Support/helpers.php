<?php

if (! function_exists('numToOrdinalWord')) {
    function numToOrdinalWord($num)
    {
        $first_word = ['eth','First','Second','Third','Fouth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth','Elevents','Twelfth','Thirteenth','Fourteenth','Fifteenth','Sixteenth','Seventeenth','Eighteenth','Nineteenth','Twentieth'];
        $second_word =['','','Twenty','Thirty','Forty','Fifty'];

        if($num <= 20) {
            return $first_word[$num];
        }

        $first_num = substr($num,-1,1);
        $second_num = substr($num,-2,1);

        return str_replace('y-eth','ieth',$second_word[$second_num].'-'.$first_word[$first_num]);
    }
}