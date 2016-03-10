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

use Azatyan\ArmenianLocaleBundle\Services\Translit;

/**
 * Class TrasnlitTest.
 */
class TranslitTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Check Translit function.
     */
    public function testLatinToArmenian()
    {
        $input = 'Barev';
        $expected = 'Բարև';

        $translit = new Translit();

        $actual = $translit->latinToArmenian($input);
        $this->assertSame($expected, $actual, 'Translit Test Failed');
    }
}
