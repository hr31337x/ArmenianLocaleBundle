<?php
/**
 *  @author Tigran Azatyan
 */

namespace Azatyan\ArmenianLocaleBundle\Services;

/**
 * Class Translit
 * @package Azatyan\ArmenianLocaleBundle\Services
 *
 * To resolve armenian translit issues
 *
 */
class Translit
{
    /**
     * Converts latin symbols in text to armenian translit equivalents
     * @param $inString
     * @return string
     */
    public function latinToArmenian($inString)
    {

        $inOneCharLetters = "ABGDEZILXKHMYNOPJSVWTRCQFabgdez@ilx\$kh&mynopjsvwtrcqf?";
        $outOneCharLetters = "ԱԲԳԴԵԶԻԼԽԿՀՄՅՆՈՊՋՍՎՎՏՐՑՔՖաբգդեզըիլխծկհճմյնոպջսվվտրցքֆ՞";
        $inTwoCharLetters = "YEYeE'EEEeY'@@THThZHZhJHJhKHKhC'TSTsD'DZDzGHGhTWTw&&SHShVOVoCHChR'RRRrP'PHPhO'OOOoyee'eey'thzhjhkhc'tsd'dzghtwshvochr'rrp'phevo'oo";
        $outTwoCharLetters = "ԵԵԷԷԷԸԸԹԹԺԺԺԺԽԽԾԾԾՁՁՁՂՂՃՃՃՇՇՈՈՉՉՌՌՌՓՓՓՕՕՕեէէըթժժխծծձձղճշոչռռփփևօօ";
        $inThreeCharLetters = "Uu";
        $outThreeCharLetters = "Ուու";
        $inStringLength = mb_strlen($inString, "UTF-8");
        $outString = "";

        for ($i = 0; $i < $inStringLength; $i++) {
            $is2char = false;
            if ($i < ($inStringLength - 1)) {

                for ($j = 0; $j < mb_strlen($outTwoCharLetters ,"UTF-8"); $j++) {
                    if (mb_substr($inString, $i, 2, "UTF-8") == mb_substr($inTwoCharLetters, $j * 2, 2, "UTF-8")) {
                        $outString .= mb_substr($outTwoCharLetters, $j, 1, "UTF-8");
                        $i++;
                        $is2char = true;

                    }
                }
            }
            if (!$is2char) {
                $currentCharacter = mb_substr($inString, $i, 1, "UTF-8");

                $pos = mb_strpos($inThreeCharLetters, $currentCharacter,0, "UTF-8");

                if ($pos == 0) {
                    $pos = mb_strpos($inOneCharLetters, $currentCharacter, 0, "UTF-8");
                    if ($pos == 0) {
                        $outString .= $currentCharacter;
                    } else {
                        $outString .= mb_substr($outOneCharLetters, $pos, 1, "UTF-8");
                    }
                } else {
                    $outString .= mb_substr($outThreeCharLetters, $pos * 2, 2, "UTF-8");
                }
            }
        }

        return $outString;
    }
}
