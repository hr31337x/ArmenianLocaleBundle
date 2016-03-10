<?php

/*
 * This file is part of the ArmenianLocaleBundle.
 * Symfony Framework Bundle
 *
 * @author Tigran Azatyan <tigran@azatyan.info>
 *
 * @copyright Tigran Azatyan  2013 - 2016
 */

namespace Azatyan\ArmenianLocaleBundle\Services;

/**
 * Armscii to Unicode Conversation
 * Class Unicode.
 */
class Encoding
{
    /**
     * Armscii.
     *
     * @var string
     */
    private $armsciiLetters = '²´¶¸º¼¾ÀÂÄÆÈÊÌÎÐÒÔÖØÚÜÞàâäæèêìîðòôöøúü³µ·•¹»½¿ÁÃÅÇÉËÍÏÑÓÕ×ÙÛÝßáãåçéëíïñóõ÷ù¨ûý';

    /**
     * Unicode.
     *
     * @var string
     */
    private $unicodeLetters = 'ԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՒՓՔՕՖաբգգդեզէըթժիլխծկհձղճմյնշոչպջռսվտրցւփքևօֆ';

    /**
     * Method For Converting From Armscii to Unicode.
     *
     * @param $inString
     *
     * @return string
     */
    public function armsciiToUnicode($inString)
    {
        $inStringLength = mb_strlen($inString, 'UTF-8');
        $outString = '';

        for ($i = 0; $i < $inStringLength; ++$i) {
            $currentCharacter = mb_substr($inString, $i, 1, 'UTF-8');
            $pos = mb_strpos($this->armsciiLetters, $currentCharacter, 1, 'UTF-8');
            if ($pos < -1) {
                $outString .= $currentCharacter;
            } else {
                $outString .= mb_substr($this->unicodeLetters, $pos, 1, 'UTF-8');
            }
        }

        return $outString;
    }

    /**
     * Method For Converting From Unicode to Armscii.
     *
     * @param $inString
     *
     * @return string
     */
    public function unicodeToArmscii($inString)
    {
        $inStringLength = mb_strlen($inString, 'UTF-8');
        $outString = '';

        for ($i = 0; $i < $inStringLength; ++$i) {
            $currentCharacter = mb_substr($inString, $i, 1, 'UTF-8');

            $pos = mb_strpos($this->unicodeLetters, $currentCharacter, 1, 'UTF-8');
            if ($pos < -1) {
                $outString .= $currentCharacter;
            } else {
                $outString .= mb_substr($this->armsciiLetters, $pos, 1, 'UTF-8');
            }
        }

        return $outString;
    }
}
