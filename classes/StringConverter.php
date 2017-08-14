<?php

class StringConverter {

    const TRANSLIT_TABLE = [
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "e",
        "ж" => "zh",
        "з" => "z",
        "и" => "i",
        "й" => "j",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "u",
        "ф" => "f",
        "х" => "h",
        "ц" => "c",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "sch",
        "ъ" => "",
        "ы" => "y",
        "ь" => "",
        "э" => "e",
        "ю" => "ju",
        "я" => "ja"
    ];

    static function translit($string) {
        $string = strtolower($string);
        $string = mb_convert_encoding($string, "windows-1251");
        $stringLength = strlen($string);
        $translitTable = self::TRANSLIT_TABLE;

        $newStringAr = [];

        for ($i=0; $i < $stringLength; $i++) {
            $sign = $string[$i];
            $translitSign = $sign;

            if (preg_match("/^[а-я]/iu", $sign)) {
                $translitSign = $translitTable[$sign];
            }
          /*  if (!preg_match("/^[a-zа-я0-9]/i", $sign)) {
                $translitSign = "_";
            }*/

            array_push($newStringAr, $translitSign);
        }

        $newString = implode($newStringAr);

        return $newString;
    }

}