<?php
/**
 *
 */

namespace Frootbox\Http\Traits;

trait UrlSanitize {

    /**
     *
     */
    public function getStringUrlSanitized ( string $string = null ): string
    {
        if (empty($string)) {
            return (string) null;
        }

        $string = mb_strtolower($string);

        $tr = [
            '[br]'	=>	'-',
            '?'		=>	'',
            '#'		=>	'',

            ' & '	=>	' und ',
            '–'		=>	' bis ',

            'ä'		=>	'ae',
            'ü'		=>	'ue',
            'ö'		=>	'oe',
            'ß'		=>	'ss',
        ];

        $string = strtr($string, $tr);


        // Transcriptions
        $tr = array(
            'К'	=>	'K',
            'к'	=>	'k',
            'м'	=>	'm',
            'М'	=>	'M',
            'а'	=>	'a',
            'Б'	=>	'B',
            'б'	=>	'b',
            'В'	=>	'V',
            'в'	=>	'v',
            'Г'	=>	'G',
            'г'	=>	'g',
            'Д'	=>	'D',
            'д'	=>	'd',
            'Ж'	=>	'Z',
            'ж'	=>	'z',
            'З'	=>	'Z',
            'з'	=>	'z',
            'И'	=>	'I',
            'и'	=>	'i',
            'Й'	=>	'J',
            'й'	=>	'j',
            'Л'	=>	'L',
            'л'	=>	'l',
            'Н'	=>	'N',
            'н'	=>	'n',
            'П'	=>	'P',
            'п'	=>	'p',
            'Р'	=>	'R',
            'р'	=>	'r',
            'С'	=>	'S',
            'с'	=>	's',
            'Т'	=>	'T',
            'т'	=>	't',
            'У'	=>	'U',
            'у'	=>	'u',
            'Ф'	=>	'F',
            'ф'	=>	'f',
            'Х'	=>	'H',
            'х'	=>	'h',
            'Ц'	=>	'C',
            'ц'	=>	'c',
            'Ч'	=>	'C',
            'ч' =>	'c',
            'Ш'	=>	'S',
            'ш'	=>	's',
            'Щ'	=>	'Sc',
            'щ'	=>	'sc',
            'Ы'	=>	'Y',
            'ы'	=>	'y',
            'Э'	=>	'E',
            'э'	=>	'e',
            'Ю'	=>	'Ju',
            'ю'	=>	'Ju',
            'Я'	=>	'Ja',
            'я'	=>	'ja',
            'е'	=>	'e',
            'о'	=>	'o'

        );

        $string	=	strtolower(strtr($string, $tr));

        $string	=	preg_replace('#\s#', '-', $string);
        $string	=	preg_replace('#[^a-z0-9\-]#', '', $string);


        $string	=	preg_replace('#[\-]{2,}#i', '-', $string);

        if (empty($string)) {
            return (string) null;
        }

        if ($string[0] == '-') {
            $string	=	substr($string, 1);
        }

        if (substr($string, -1) == '-') {
            $string	=	substr($string, 0, -1);
        }

        return $string;
    }
}