<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Markdown;
use Tests\TestCase;

/**
 * Class MarkdownTest
 *
 * @package Tests\Unit\Helpers
 *
 * @author Alexander Schilling
 */
class MarkdownTest extends TestCase
{
    public function testMarkdownWork()
    {
        $markdownText = Markdown::process('**Hallo welt**');
        $parsedHtml = '<p><strong>Hallo welt</strong></p>';

        $this->assertStringContainsString($parsedHtml, $markdownText);
    }
}
