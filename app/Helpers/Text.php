<?php

namespace App\Helpers;

/**
 * Class Text
 *
 * @package App\Helpers
 *
 * @author Alexander Schilling
 */
class Text
{
    /**
     * Cut text
     *
     * @param string $text
     * @param string|null $moreLink
     *
     * @return string
     */
    public static function cut(string $text, ?string $moreLink = null): string
    {
        $text = explode('[cut]', $text, 2);
        return empty($text[1]) ? $text[0] : $moreLink === null ? $text[0] : $text[0] . "\n$moreLink";
    }

    /**
     * Hide cut text
     *
     * @param string $text
     *
     * @return string
     */
    public static function hideCut(string $text): string
    {
        return str_replace('[cut]', '', $text);
    }
}
