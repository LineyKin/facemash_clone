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
        "я" => "ja",

        "А" => "A",
        "Б" => "B",
        "В" => "V",
        "Г" => "G",
        "Д" => "D",
        "Е" => "E",
        "Ё" => "E",
        "Ж" => "ZH",
        "З" => "Z",
        "И" => "I",
        "Й" => "J",
        "К" => "K",
        "Л" => "L",
        "М" => "M",
        "Н" => "N",
        "О" => "O",
        "П" => "P",
        "Р" => "R",
        "С" => "S",
        "Т" => "T",
        "У" => "U",
        "Ф" => "F",
        "Х" => "H",
        "Ц" => "C",
        "Ч" => "CH",
        "Ш" => "SH",
        "Щ" => "SCH",
        "Ъ" => "",
        "Ы" => "Y",
        "Ь" => "",
        "Э" => "E",
        "Ю" => "JU",
        "Я" => "JA",

        "№" => "_"
    ];

    static function translit($string) {

        $translitTable = self::TRANSLIT_TABLE;
        $translitString = strtr($string, $translitTable);

        $arTranslitString = str_split($translitString);

        foreach ($arTranslitString as $key => &$sign) {
            if (!preg_match("/^[a-zа-я0-9]/i", $sign)) {
                $sign = "_";
            }
        }

        $newString = implode($arTranslitString);
        $newString = strtolower($newString);

        return $newString;
    }

}