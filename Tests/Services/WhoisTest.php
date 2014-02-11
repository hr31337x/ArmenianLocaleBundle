<?php

/**
 *  @author ArmCoder
 */

namespace ArmCoder\ArmenianLocaleBundle\Tests\Services;

use ArmCoder\ArmenianLocaleBundle\Services\Whois;

/**
 * Class WhoisTest
 * @package ArmCoder\ArmenianLocaleBundle\Tests\Services
 */
class WhoisTest extends \PHPUnit_Framework_TestCase
{

    /**
     *  Check Whois function
     */
    public function testGet()
    {

        $whois = new Whois('whois.amnic.net');
        $info = $whois->get("amnic.am");
        $this->assertNotEquals(false,$info,"Whois Test Failed");
    }
}
