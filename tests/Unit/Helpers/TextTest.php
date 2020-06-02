<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Text;
use PHPUnit\Framework\TestCase;

/**
 * Class TextTest
 *
 * @package Tests\Unit\Helpers
 *
 * @author Alexander Schilling
 */
class TextTest extends TestCase
{

    public $data = 'Lorem ipsum dolor sit amet. [cut] Consectetur adipisicing elit. Accusantium blanditiis cum.';

    public function testCut()
    {
        $this->assertEquals(28, strlen(Text::cut($this->data)));
    }

    public function testCutWithMoreLink()
    {
        $this->assertEquals(36, strlen(Text::cut($this->data, 'More...')));
    }

    public function testHideCut()
    {
        $this->assertEquals(86, strlen(Text::hideCut($this->data)));
    }
}
