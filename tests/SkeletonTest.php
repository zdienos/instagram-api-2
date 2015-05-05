<?php
 
use Vagovszky\Skeleton\Skeleton;
 
class SkeletonTest extends PHPUnit_Framework_TestCase {
 
  public function testSkeletonHasCheese()
  {
    $nacho = new Skeleton;
    $this->assertTrue($nacho->hasCheese());
  }
 
}