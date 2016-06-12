<?php

require_once("vendor/autoload.php");

$d = new \Azatyan\ArmenianLocaleBundle\Services\HaykyanDate();

print_r($d->create(1)->get());
