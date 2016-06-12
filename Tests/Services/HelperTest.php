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

use Azatyan\ArmenianLocaleBundle\Services\Helper;

/**
 * Class HelperTest.
 */
class HelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Check getAlphabet Method.
     */
    public function testGetAlphabet()
    {
        $helper = new Helper();
        $capitals = $helper->getAlphabet(true);
        $lowercases = $helper->getAlphabet(false);

        $this->assertSame(38, count($capitals), 'Capitals');
        $this->assertSame(39, count($lowercases), 'Lowercases');
    }
}
