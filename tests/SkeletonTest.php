<?php

use Vagovszky\Skeleton\Skeleton;

class SkeletonTest extends PHPUnit_Framework_TestCase {

    private $skeleton;

    protected function setUp() {
        $this->skeleton = new Skeleton();
    }

    public function testSkeletonHasCheese() {
        $this->assertTrue($this->skeleton->hasCheese(true));
    }
}
