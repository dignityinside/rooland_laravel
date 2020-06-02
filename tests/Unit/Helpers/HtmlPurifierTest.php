<?php

namespace Tests\Unit\Helpers;

use App\Helpers\HtmlPurifier;
use Tests\TestCase;

/**
 * Class HtmlPurifierTest
 *
 * @package Tests\Unit\Helpers
 *
 * @author Alexander Schilling
 */
class HtmlPurifierTest extends TestCase
{
    public function testHtmlPurifier()
    {
        $data = "I'm evil code: <script>alert('hallo welt');</script>";
        $this->assertNotEquals(HtmlPurifier::process($data), $data);
    }
}
