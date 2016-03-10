<?php

/*
 * This file is part of the ArmenianLocaleBundle.
 * Symfony Framework Bundle
 *
 * @author Tigran Azatyan <tigran@azatyan.info>
 *
 * @copyright Tigran Azatyan  2013 - 2016
 */

namespace Azatyan\ArmenianLocaleBundle\Tests\Services;

use Azatyan\ArmenianLocaleBundle\Services\Encoding;

/**
 * Class EncodingTest.
 */
class EncodingTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Check Encoding function.
     */
    public function testUnicodeArmsciiArmenian()
    {
        $encoding = new Encoding();

        $armscii = 'Ð³Û³ëï³ÝÁ (å³ßïáÝ³Ï³Ý ³Ýí³ÝáõÙÁ՝ Ð³Û³ëï³ÝÇ Ð³Ýñ³å»ïáõÃÛáõÝ) ó³Ù³ù³ÛÇÝ å»ïáõÃÛáõÝ ¿ ²Ý¹ñÏáíÏ³ëáõÙ։ ²ßË³ñÑ³·ñáñ»Ý ·ïÝíáõÙ ¿ ÑÛáõëÇë³ñ¨ÙïÛ³Ý ²ëÇ³ÛáõÙ, ë³Ï³ÛÝ Ùß³ÏáõÃ³ÛÇÝ ¨ ù³Õ³ù³Ï³Ý ÝÏ³ï³éáõÙÝ»ñáí Ñ³Ù³ñíáõÙ ¿ »íñáå³Ï³Ý »ñÏÇñ։ ÐÛáõëÇëÇó ë³ÑÙ³Ý³ÏÇó ¿ ìñ³ëï³ÝÇÝ, ³ñ¨»ÉùÇó՝ ²¹ñµ»ç³ÝÇÝ, Ñ³ñ³í³ñ¨»ÉùÇó՝ È»éÝ³ÛÇÝ Ô³ñ³µ³ÕÇÝ, Ñ³ñ³íÇó՝ Æñ³ÝÇÝ, Ñ³ñ³í³ñ¨ÙáõïùÇó՝ ²¹ñµ»ç³ÝÇ Ù³ë Ï³½ÙáÕ Ü³ËÇç¨³ÝÇ ÆÝùÝ³í³ñ Ð³Ýñ³å»ïáõÃÛ³ÝÁ ¨ ³ñ¨ÙáõïùÇó՝ ÂáõñùÇ³ÛÇÝ։';
        $unicode = $encoding->armsciiToUnicode($armscii);
        $actual = $encoding->unicodeToArmscii($unicode);
        $this->assertSame($armscii, $actual, 'Encoding Test Failed');
    }
}
