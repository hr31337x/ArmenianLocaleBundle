<?php

/**
 *  @author Tigran Azatyan
 */

namespace Azatyan\ArmenianLocaleBundle\Tests\Services;

use Azatyan\ArmenianLocaleBundle\Services\Translit;

/**
 * Class TrasnlitTest
 * @package Azatyan\ArmenianLocaleBundle\Tests\Services
 */
class TrasnlitTest extends \PHPUnit_Framework_TestCase
{

    /**
     *  Check Translit function
     */
    public function testLatinToArmenian()
    {
        $input = "Barev";
        $expected = "Բարև";

        $translit = new Translit();

        $actual =  $translit->latinToArmenian($input);
        $this->assertEquals($expected, $actual,"Translit Test Failed");
    }
}
