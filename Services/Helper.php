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
 * Class Helper.
 */
class Helper
{
    /**
     * Get Armenian Alphabet as Array
     * @param $capital bool
     *
     * @return array
     */
    public function getAlphabet($capital = true)
    {
        if ($capital) {
            return $this->range('Ա', 'Ֆ');
        } else {
            return $this->range('ա', 'և');
        }
    }

    /**
     * Multi-byte Range
     * @param $start
     * @param $end
     *
     * @author https://github.com/rodneyrehm
     *
     * @return array
     */
    private function range($start, $end)
    {
        // if start and end are the same, well, there's nothing to do
        if ($start == $end) {
            return [$start];
        }

        $_result = [];
        // get unicodes of start and end
        list(, $_start, $_end) = unpack('N*', mb_convert_encoding($start.$end, 'UTF-32BE', 'UTF-8'));
        // determine movement direction
        $_offset = $_start < $_end ? 1 : -1;
        $_current = $_start;
        while ($_current != $_end) {
            $_result[] = mb_convert_encoding(pack('N*', $_current), 'UTF-8', 'UTF-32BE');
            $_current += $_offset;
        }
        $_result[] = $end;

        return $_result;
    }
}
