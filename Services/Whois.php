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
 * Class Whois.
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
     *
     * @return string
     */
    public function get($domain)
    {
        $fp = fsockopen($this->server, $this->port, $errno, $errstr, $this->timeout);

        if (!$fp) {
            return false;
        }

        fputs($fp, $domain."\r\n");
        $out = '';
        while (!feof($fp)) {
            $out .= fgets($fp);
        }
        fclose($fp);

        $res = '';
        if ((strpos(strtolower($out), 'error') === false) && (strpos(strtolower($out), 'not allocated') === false)) {
            $rows = explode("\n", $out);
            foreach ($rows as $row) {
                $row = trim($row);
                if (($row !== '') && ($row{0} !== '#') && ($row{0} !== '%')) {
                    $res .= $row."\n";
                }
            }
        } else {
            return false;
        }

        return $res;
    }
}
