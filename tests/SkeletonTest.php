<?php
 
use Vagovszky\Skeleton\Skeleton;
 
class SkeletonTest extends PHPUnit_Framework_TestCase {
 
  public function testSkeletonHasCheese()
  {
    $skeleton = new Skeleton;
    $this->assertTrue($skeleton->hasCheese());
  }
 
}