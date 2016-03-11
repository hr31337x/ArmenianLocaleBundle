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

use Azatyan\ArmenianLocaleBundle\Services\Whois;

/**
 * Class WhoisTest.
 */
class WhoisTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Check Whois Method.
     */
    public function testGet()
    {
        $whois = new Whois('whois.amnic.net');
        $info = $whois->get('amnic.am');
        $this->assertNotFalse($info, 'Whois Test Failed');
    }
}
