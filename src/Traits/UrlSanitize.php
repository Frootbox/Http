<?php
/**
 * @author Jan Habbo Brüning <jan.habbo.bruening@gmail.com>
 */

namespace Frootbox\Http\Traits;

trait UrlSanitize
{
    /**
     * @param string|null $string
     * @param string|null $language
     * @return string|null
     */
    public function getStringUrlSanitized(string $string = null, string $language = null): ?string
    {
        if ($string == null) {
            return null;
        }

        if ($language == null) {
            $language = 'de-DE';
        }

        $string = strip_tags($string);
        $string = str_replace('---', '', $string);

        if (empty($string)) {
            return (string) null;
        }

        $string = mb_strtolower($string);
        $string = html_entity_decode($string);

        $ands = [
            'de-DE' => 'und',
            'nl-NL' => 'en',
        ];

        $and = !empty($ands[$language]) ? $ands[$language] : 'und';

        $tr = [
            '[br]' => '-',
            '?' => '',
            '#' => '',

            ' & ' => ' ' . $and . ' ',
            '–' => ' bis ',

            'ä' => 'ae',
            'ü' => 'ue',
            'ö' => 'oe',
            'ß' => 'ss',
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
            'о'	=>	'o',
        );

        $string = strtolower(strtr($string, $tr));

        $string = preg_replace('#\s#', '-', $string);
        $string = preg_replace('#[^a-z0-9\-]#', '', $string);


        $string = preg_replace('#[\-]{2,}#i', '-', $string);

        if (empty($string)) {
            return (string) null;
        }

        if ($string[0] == '-') {
            $string = substr($string, 1);
        }

        if (substr($string, -1) == '-') {
            $string = substr($string, 0, -1);
        }

        return trim($string);
    }
}
