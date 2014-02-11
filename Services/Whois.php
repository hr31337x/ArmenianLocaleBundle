<?php
/**
 * @author ArmCoder
 */

namespace ArmCoder\ArmenianLocaleBundle\Services;


/**
 * Class Whois
 * @package ArmCoder\ArmenianLocaleBundle\Services
 */
class Whois
{

    /**
     * @var
     */
    private $server;


    /**
     * @var
     */
    private $port = 43;


    /**
     * @var
     */
    private $timeout = 10;

    /**
     * @param $server
     */
    public function __construct($server)
    {
        $this->server = $server;
    }

    /**
     * @param $domain
     * @return string
     */
    public function get($domain)
    {
        $fp = fsockopen($this->server, $this->port, $errno, $errstr, $this->timeout);

        if (!$fp) {
            return false;
        }

        fputs($fp, $domain . "\r\n");
        $out = "";
        while (!feof($fp)) {
            $out .= fgets($fp);
        }
        fclose($fp);

        $res = "";
        if ((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
            $rows = explode("\n", $out);
            foreach ($rows as $row) {
                $row = trim($row);
                if (($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
                    $res .= $row . "\n";
                }
            }
        } else {
            return false;
        }
        return $res;
    }

}
