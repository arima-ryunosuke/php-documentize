<?php

namespace ryunosuke\Documentize\Utils;

class Adhoc
{
    public static function fnmatchs($patterns, $string, $flags = 0)
    {
        foreach ((array) $patterns as $pattern) {
            if (fnmatch($pattern, $string, $flags)) {
                return true;
            }
        }
        return false;
    }

    public static function explode($string, $delimiters, $enclosures, $escape)
    {
        $starts = implode('', array_keys($enclosures));
        $ends = implode('', $enclosures);
        $enclosing = [];
        $current = 0;
        $result = [];
        for ($i = 0, $l = strlen($string); $i < $l; $i++) {
            if ($i !== 0 && $string[$i - 1] === $escape) {
                continue;
            }
            if (strpos($ends, $string[$i]) !== false) {
                if ($enclosing && $enclosures[$enclosing[count($enclosing) - 1]] === $string[$i]) {
                    array_pop($enclosing);
                    continue;
                }
            }
            if (strpos($starts, $string[$i]) !== false) {
                $enclosing[] = $string[$i];
                continue;
            }
            if (empty($enclosing) && strpos($delimiters, $string[$i]) !== false) {
                $result[] = substr($string, $current, $i - $current);
                $current = $i + 1;
            }
        }
        $result[] = substr($string, $current, $i);
        return $result;
    }
}
