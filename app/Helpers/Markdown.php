<?php

namespace App\Helpers;

use \cebe\markdown\GithubMarkdown;

/**
 * Class Markdown
 *
 * @package App\Helpers
 *
 * @author Alexander Schilling
 */
class Markdown
{

    /**
     * Process
     *
     * @param string $markdown
     *
     * @return string
     */
    public static function process(string $markdown): string
    {
        $parser = new GithubMarkdown();
        $parser->enableNewlines = true;
        $parser->keepListStartNumber = true;
        $parser->html5 = true;

        return $parser->parse($markdown);
    }
}
